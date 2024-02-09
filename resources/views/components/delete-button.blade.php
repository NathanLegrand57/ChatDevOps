@props(['property', 'model'])

<form method="POST" action="{{ route($property . '.destroy', [$property => $model->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-user m-1">{{ 'Supprimer' }}</button>
</form>
