
@extends('mahasiswas.layout')
 
@section('content')
    <div class="row justify-content-center mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2 mb-3 text-center ">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
            </div>
            
        </div>
        <div class="col-md-6">
            <form action="/mahasiswas">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search.." name="search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>     
            </form>
        </div>
           
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>Email</th>
            <th>Tanggal_Lahir</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($paginate as $Mahasiswa)
        <tr>
            
            <td>{{ $Mahasiswa->Nim }}</td>
            <td>{{ $Mahasiswa->Nama }}</td>
            <td>{{ $Mahasiswa->Kelas->nama_kelas}}</td>
            <td>{{ $Mahasiswa->Jurusan }}</td>
            <td>{{ $Mahasiswa->No_Handphone }}</td>
            <td>{{ $Mahasiswa->Email }}</td>
            <td>{{ $Mahasiswa->Tanggal_Lahir }}</td>
            <td>
            <form action="{{ route('mahasiswas.destroy',$Mahasiswa->Nim) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('mahasiswas.show',$Mahasiswa->Nim) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$Mahasiswa->Nim) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $paginate->links() }}
    
@endsection

