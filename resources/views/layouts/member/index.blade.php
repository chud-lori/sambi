@extends('layouts.tamplate.master')
@section('title','anggotasiswa')

@section('content')
<!-- Isi File member.php-->
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-8">
      <section class="content-header">
        <h1>Data Anggota Perpustakaan "Cemerlang" SMK N 1 Sambi</h1>
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
                <div class="col-md-2">
                  <a href="{{ route('member.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Anggota</a>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-4">
                  <form class="">
                    <div class="input-group">
                      <input type="file" class="form-control">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-primary">Import</button>
                      </div>
                    </div>
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
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>Jurusan</th>
                      <th>Kelas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($members as $member)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$member->nama}}</td>
                      <td>{{$member->nomor_anggota}}</td>
                      <td>{{$member->jurusan_gurumapel}}</td>
                      <td>{{$member->kelas}}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Action &nbsp;
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('member.show', $member->id)}}"><i class="fa fa-folder-open">&nbsp; Detail</i></a></li>
                            <li><a href="{{ route('member.edit',$member->id) }}"><i class="fa fa-edit">&nbsp; Edit</i></a></li>
                            <li class="divider"></li>
                            <li>
                              <a href="">
                                <form action="{{ route('member.destroy', $member->id) }}" method="POST">
                                @csrf
                                  <button class="btn btn-block btn-danger" type="submit" name="delete" onclick="javascript: return confirm('Hapus data dengan nama {{$member->nama}}')">
                                    <i class="fa fa-trash">&nbsp; Hapus</i>
                                  </button>
                                  <input type="hidden" name="_method" value="delete" >
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
                      <th>Nama</th>
                      <th>Nomor Anggota</th>
                      <th>Jurusan</th>
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

