<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Exports\UsersExport;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;
 

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.index');
    }

    public function login()
    {
        //
        return view('dashboard.login');
    }



    public function register()
    {
        //
        return view('dashboard.register');
    }

    

    public function inputRegister(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required|min:4|max:50',
            'address' => 'required',
            'no_hp'=> 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'berhasil membuat akun!');
    }

    public function auth(Request $request)
    {
        

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect ('/admin')->with('successLogin', "Welcome");
            }else{
                return redirect('/')->with('successLogin', "Welcome");
            }
        } else {
            return redirect('/login')->with('fail', "Email-Address And Password Are Wrong");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('successLogout', 'berhasil keluar akun');
    }

    public function admin()
    {

        return view('admindashboard.index');
    }













    public function library(Request $request)
    {
        $kategori = Category::all();
        $buku = Buku::all();

        // Cek apakah $buku merupakan nilai boolean

        // Jika tidak, kirimkan variabel $buku ke view
        return view('User.library', compact('kategori', 'buku'));
    }
    
    public function getBooksByCategory(Request $request, $category)
    {
        $kategori = Category::all();
        if ($category == 'all') {
            $buku = Buku::all();
        } else {
            $buku = Buku::where('category', $category)->get();
        }
        return view('User.library', compact('kategori', 'buku'));
    }

    public function user()
    {
        $users = User::all();
        return view('admindashboard.user', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::Where('id', $id)->first();
        return view('admindashboard.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function updateuser(Request $request, $id)
    {
        //
        $request->validate([
            'email' => 'required',
            'name' => 'required|min:4|max:50',
            'address' => 'required',
            'password' => 'required',
            'no_hp'=> 'required',
            'role'=> 'required',

        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => $request->role,
 
        ]);

        return redirect()->route('user')->with('successUpdate', 'Berhasil mengubah data user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroyuser($id)
    {
        //
        User::where('id', '=', $id)->delete();
        return redirect()->route('user')->with('successDelete', 'Berhasil menghapus data user');
    }

    public function exportToExcel() {
        $users = User::select('name', 'address', 'no_hp', 'email', 'role', 'created_at', 'updated_at')->get();
    
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('Users');
    
        // Add table headers
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Name')
                    ->setCellValue('B1', 'Address')
                    ->setCellValue('C1', 'No Handphone')
                    ->setCellValue('D1', 'Email')
                    ->setCellValue('E1', 'Role')
                    ->setCellValue('F1', 'Created_at')
                    ->setCellValue('G1', 'Updated_at');
    
        // Add table data
        $row = 2;
        foreach($users as $user) {
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, $user->name)
                        ->setCellValue('B' . $row, $user->address)
                        ->setCellValue('C' . $row, $user->no_hp)
                        ->setCellValue('D' . $row, $user->email)
                        ->setCellValue('E' . $row, $user->role)
                        ->setCellValue('F' . $row, $user->created_at)
                        ->setCellValue('G' . $row, $user->updated_at);
            $row++;
        }
    
        // Set auto width for columns
        foreach(range('A', 'G') as $column) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
        }
    
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="users.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function userExportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function userPrintable()
    {
        $users = User::all();
        return view('print.userPrintable', compact('users'));
    }












    


    public function book()
    {
        $kategori = Category::all();
        $buku = Buku::all();
        return view('admindashboard.book', compact('kategori', 'buku'));
    }

    public function createBook()
    {
        $kategori = Category::all();
        $buku = Buku::all();
        return view('admindashboard.createBook', compact('kategori', 'buku'));
    }

    public function editBook($id)
    {
        $kategori = Category::all();
        $buku = Buku::Where('id', $id)->first();
        return view('admindashboard.editBook', compact('kategori', 'buku'));
    }


    public function bookstore(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:5',
            'writer' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'synopsis' => 'required|min:10',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'pdf' => 'required|mimes:pdf',
        ]);

        // Simpan file yang diupload ke direktori
        $image = $request->file('cover');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/images/books', $filename);

         // Simpan file PDF yang diupload ke direktori
        $pdf = $request->file('pdf');
        $pdfname = time() . '.' . $pdf->getClientOriginalExtension();
        $pdfpath = $pdf->storeAs('public/pdf/books', $pdfname);

        // Simpan nama file ke database
        $book = new Buku();
        $book->cover = $filename;
        $book->pdf = $pdfname;

        // Simpan data book ke database
        $book->title = $request->input('title');
        $book->writer = $request->input('writer');
        $book->publisher = $request->input('publisher');
        $book->isbn = $request->input('isbn');
        $book->category = $request->input('category');
        $book->synopsis = $request->input('synopsis');
        $book->save();

        return redirect('book')->with('uploadBuku', 'Book has been created.');
    }

    public function updateBook(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:5',
            'writer' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'synopsis' => 'required|min:10',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        // Cari buku yang akan diupdate
        $book = Buku::find($id);
        if (!$book) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }   
    
        // Simpan file yang diupload ke direktori
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images/books', $filename);
    
            // Hapus cover lama
            Storage::delete('public/images/books/'.$book->cover);
    
            // Simpan nama file ke database
            $book->cover = $filename;
        }
    
        // Simpan data buku ke database
        $book->title = $request->input('title');
        $book->writer = $request->input('writer');
        $book->publisher = $request->input('publisher');
        $book->isbn = $request->input('isbn');
        $book->category = $request->input('category');
        $book->synopsis = $request->input('synopsis');
        $book->save();
    
        return redirect()->route('book')->with('bookUpdate', 'Buku berhasil diupdate');
    }


    public function bookDestroy($id)
    {
        //
        Buku::where('id', '=', $id)->delete();
        return redirect()->route('book')->with('bookDelete', 'Berhasil menghapus buku');
    }


    public function exportBookToExcel() {
        $buku = Buku::select('title', 'writer', 'publisher', 'isbn', 'category', 'synopsis', 'cover')->get();
    
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('Bukus');
    
        // Add table headers
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Title')
                    ->setCellValue('B1', 'Writer')
                    ->setCellValue('C1', 'Publisher')
                    ->setCellValue('D1', 'Isbn')
                    ->setCellValue('E1', 'Category')
                    ->setCellValue('F1', 'Synopsis')
                    ->setCellValue('G1', 'Cover');
    
        // Add table data
        $row = 2;
        foreach($buku as $book) {
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, $book->title)
                        ->setCellValue('B' . $row, $book->writer)
                        ->setCellValue('C' . $row, $book->publisher)
                        ->setCellValue('D' . $row, $book->isbn)
                        ->setCellValue('E' . $row, $book->category)
                        ->setCellValue('F' . $row, $book->synopsis)
                        ->setCellValue('G' . $row, "<img src='{{ asset('storage/images/books/'. $book->cover) }}'");
            $row++;
        }
    
        // Set auto width for columns
        foreach(range('A', 'G') as $column) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
        }
    
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="books.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function bookExportExcel()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }








    public function category()
    {
        $kategori = Category::all();
        return view('admindashboard.category', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'category' => 'required',
        ]);

        Category::create([
            'category' => $request->category,
        ]);

        return redirect()->route('category')->with('successadd','Berhasil menambahkan data kategori');
    }

    public function editCategory($id)
    {
        $kategori = Category::Where('id', $id)->first();
        return view('admindashboard.editCategory', compact('kategori'));
    }

    public function updateCategory(Request $request, $id)
    {
        //
        $request->validate([
            'category' => 'required',

        ]);

        Category::where('id', $id)->update([
            'category' => $request->category,
 
        ]);

        return redirect()->route('category')->with('categoryUpdate', 'Berhasil mengubah data kategori');
    }

    public function categoryDestroy($id)
    {
        //
        Category::where('id', '=', $id)->delete();
        return redirect()->route('category')->with('categoryDelete', 'Berhasil menghapus data category');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */


    

}
