<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
    <form method="POST" action="{{ route('order.create') }}">
        <div>
            <select name="products[]">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <input type="number" name="quantities[]">
        </div>
        <input type="datetime" name="date">
        <select name="status">
            <option value="opened">Em Aberto</option>
            <option value="paid_out">Pago</option>
            <option value="canceled">Cancelado</option>
        </select>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>