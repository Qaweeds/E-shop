<tr>
    <td>
        <a href="{{route('product.show', $row->id)}}"><strong>{{$row->name}}</strong></a>
    </td>
    <td>
        <form action="{{route('cart.count_update', $row->id)}}" method="post">
            @csrf
            <input type="hidden" value="{{$row->rowId}}" name="rowId">
            <input type="number" min="1" value="{{$row->qty}}" name="product_count">
            <input type="submit" value="{{__('Update Count')}}" class="btn btn-outline-success">
        </form>
    </td>
    <td>{{$row->price}}$</td>
    <td>{{$row->subtotal}}$</td>
    <td>
        <form action="{{route('cart.delete')}}" method="post">
            @csrf @method('delete')
            <input type="hidden" value="{{$row->rowId}}" name="rowId">
            <input type="submit" class="btn btn-outline-danger" value="{{__('Delete')}}">
        </form>
    </td>
</tr>
