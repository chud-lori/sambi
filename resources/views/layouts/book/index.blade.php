@extends('layouts.tamplate.master')
@section('title','buku')

@section('content')
<!-- Isi File book.php-->
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-8">
      <section class="content-header">
        <h1>Data Buku Perpustakaan "Cemerlang" SMK N 1 Sambi</h1>
      </section>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- box -->
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-lg-2">
                  <a href="{{ route('book.create') }}" class="btn btn-primary btn-rounded btn-fw"><i
                      class="fa fa-plus"></i> Tambah Buku</a>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-4">
                  <form method="post" action="/book/import_excel" enctype="multipart/form-data">
                    <div class="input-group{{ $errors->has('file') ? ' is-invalid' : '' }}">
                      {{ csrf_field() }}
                      <input type="file" class="form-control" name="file">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Import</button>
                      </div>
                    </div>
                    @if ($errors->has('file'))
                    <span class="help-block">
                      <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
            @endif
            @if (session('update'))
            <div class="alert alert-info" role="alert">
              {{ session('update') }}
            </div>
            @endif
            @if (session('delete'))
            <div class="alert alert-danger" role="alert">
              {{ session('delete') }}
            </div>
            @endif
            <div class="table-responsive" style="overflow: auto">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($books as $book)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$book->isbn}}</td>
                    <td>{{$book->judul}}</td>
                    <td>{{$book->pengarang}}</td>
                    <td>{{$book->semester}}</td>
                    <td>{{$book->kelas}}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                          Action &nbsp;
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{route('book.show', $book->id)}}"><i class="fa fa-folder-open">&nbsp;
                                Detail</i></a></li>
                          <li><a href="{{route('book.edit', $book->id) }}"><i class="fa fa-edit">&nbsp; Edit</i></a>
                          </li>
                          <li class="divider"></li>
                          <li>
                            <a href="">
                              <form action="{{route('book.destroy', $book->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-block btn-danger" type="submit" name="delete"
                                  onclick="javascript: return confirm('Hapus data dengan {{$book->judul}} ')">Hapus</button>
                                <input type="hidden" name="_method" value="delete">
                              </form>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection