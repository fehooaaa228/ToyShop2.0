<form method="POST" action="http://127.0.0.1:8000/api/add_goods" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Название">
    <input type="number" name="price" placeholder="Цена">
    <input type="file" name="images[]" multiple placeholder="Изображение">
    <input type="submit" value="Добавить">
</form>

<a href="{{url('home')}}">Главная</a>
