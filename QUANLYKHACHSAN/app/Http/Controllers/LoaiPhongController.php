<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiPhong;
use App\Models\Phong;
class LoaiPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tuKhoa = trim((string) $request->query('q', ''));

        $query = LoaiPhong::withCount('phongs');

        if ($tuKhoa !== '') {
            $query->where('ten_loai_phong', 'like', '%' . $tuKhoa . '%');
        }

        $loaiphongs = $query->orderBy('ma_loai_phong', 'desc')->paginate(6)->withQueryString();

        $tongLoaiPhong = LoaiPhong::count();
        $tongSoPhong = Phong::count();

        return view('admin.loaiphong.index', compact('loaiphongs', 'tongLoaiPhong', 'tongSoPhong', 'tuKhoa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loaiphongs = LoaiPhong::all();
        return view('admin.loaiphong.create')
        ->with('loaiphongs',$loaiphongs);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ten_loai_phong' => 'required|string|max:200|unique:loai_phongs,ten_loai_phong',
        ];
        $rules_messages = [
            'ten_loai_phong.required' => 'Tên loại phòng không được để trống',
            'ten_loai_phong.string' => 'Tên loại phòng phải là chuỗi ký tự',
            'ten_loai_phong.max' => 'Tên loại phòng không được vượt quá 200 ký tự',
            'ten_loai_phong.unique' => 'Tên loại phòng đã tồn tại'
        ];
        //kiểm tra đối tượng hiện tại đã hợp lệ hay chưa nếu chưa sẽ trả về thông báo lỗi
        // validate(xác thực dữ liệu)
        $request->validate($rules, $rules_messages);
        $data = $request->only('ten_loai_phong');
        $loaiphong = LoaiPhong::create($data);
        
        if($loaiphong) {
            return redirect()->route('admin.loaiphong.index')->with('success', 'Thêm loại phòng thành công!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm loại phòng!');
        }  

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loaiphong = LoaiPhong::find($id);
        return view('admin.loaiphong.edit')
        ->with('loaiphong',$loaiphong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ten_loai_phong' => 'required|string|max:200|unique:loai_phongs,ten_loai_phong,'.$id.',ma_loai_phong',
        ];
        $rules_messages = [
            'ten_loai_phong.required' => 'Tên loại phòng không được để trống',
            'ten_loai_phong.string' => 'Tên loại phòng phải là chuỗi ký tự',
            'ten_loai_phong.max' => 'Tên loại phòng không được vượt quá 200 ký tự',
            'ten_loai_phong.unique' => 'Tên loại phòng đã tồn tại'
        ];
        //kiểm tra đối tượng hiện tại đã hợp lệ hay chưa nếu chưa sẽ trả về thông báo lỗi
        // validate(xác thực dữ liệu)
        $request->validate($rules, $rules_messages);
        $data = $request->only('ten_loai_phong');
        unset($data['_token']);
        LoaiPhong::where('ma_loai_phong',$id)->update($data);
        return redirect()->route('admin.loaiphong.index')->with('success', 'Cập nhật loại phòng thành công!');
        if($loaiphong) {
            return redirect()->route('admin.loaiphong.index')->with('success', 'Cập nhật loại phòng thành công!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật loại phòng!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LoaiPhong::destroy($id);
        return redirect()->route('admin.loaiphong.index')->with('success', 'Xóa loại phòng thành công!');
    }
}
