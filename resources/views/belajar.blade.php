<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Belajar Laravel' }}</title>
</head>
<body>
  <h1>BELAJAR MATAEMATIKA DASAR</h1>

  <a href="{{ route('tambah') }}">Tambah-tambahan</a>
  <a href="{{ route('kurang') }}">Pengurangan</a>
  <a href="{{ route('bagi') }}">Bagi-Bagian</a>
  <a href="{{ route('kali') }}">Perkalian</a>

  <a href="{{ url()->previous() }}">Kembali</a>
</body>
</html>