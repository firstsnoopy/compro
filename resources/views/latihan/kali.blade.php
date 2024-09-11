<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Perkalian</h1>
    <form action="{{route('store_perkalian')}}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="number" name="angka1" placeholder="masukan angka 1"><br><br>
        <label for="">Angka 2</label>
        <input type="number" name="angka2" placeholder="masukan angka 2"><br><br>
        <button type="submit">Hitung</button>
    </form>
    <h4>Totalnya adalah: {{$kali}}</h4>
    <a href="{{url('perkalian')}}">Back</a>
</body>
</html>
