<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10 Import Export Excel to Database Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Laravel 10 Import Export Excel to Database Example - ItSolutionStuff.com
            </div>
            <div class="card-body">
                <form action="{{ route('instansi.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import User Data</button>
                </form>

                <table class="table table-bordered mt-3">
                    <tr>
                        <th colspan="3">
                            List Of Users
                            <a class="btn btn-warning float-end" href="{{ route('instansi.export') }}">Export User
                                Data</a>
                        </th>
                    </tr>
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                    @foreach ($instansi as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

</body>

</html>
