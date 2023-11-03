@if(count($result) < 1)
<tr>
    <td colspan="8">
        <div class="text-center mt-2">
            <h4>No se encontaron {{ $name }}</h4>
            <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
        </div>
    </td>
</tr>
@endif
