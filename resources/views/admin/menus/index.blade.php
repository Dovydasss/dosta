@extends('layout.admin')

@section('content')
<style>
    .order-button i {

        transition: transform 0.3s ease; 
    }

    .order-button:hover i {
        transform: scale(1.5); 
    }
</style>
<div class="container mt-4">
    <h1>Menus</h1>
    {{-- Add New Menu Button --}}
    <a href="{{ route('menus.create') }}" class="btn btn-success mb-2">Add New Menu</a>

    {{-- Display Menus and Their Items --}}
    @foreach ($menus as $menu)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ $menu->name }} ({{ $menu->location }})</span>
            <div>



                {{-- Edit Menu Button --}}
                <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-outline-secondary mr-2">Edit Menu</a>
                {{-- Delete Menu Form --}}
                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete Menu</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <h5>Menu Items</h5>
            <a href="{{ route('menus.menuitems.create', $menu->id) }}" class="btn btn-sm btn-primary mb-2">Add New Item</a>
            <ul class="list-group">
                @foreach ($menu->menuItems as $menuItem)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $menuItem->title }}
                    <div>
                    <button class="order-button" onclick="changeOrder('{{ $menuItem->id }}', 'up', '{{ $menu->id }}')" style="background: none; border: none;">
    <i class="fa fa-arrow-up"></i>
</button>
<button class="order-button" onclick="changeOrder('{{ $menuItem->id }}', 'down', '{{ $menu->id }}')" style="background: none; border: none;">
    <i class="fa fa-arrow-down"></i>
</button>
                        {{-- Edit Menu Item Button --}}
                        <a href="{{ route('menus.menuitems.edit', ['menu' => $menu->id, 'menuitem' => $menuItem->id]) }}" class="btn btn-sm btn-outline-secondary mr-2">Edit</a>
                        {{-- Delete Menu Item Form --}}
                        <form action="{{ route('menus.menuitems.destroy', ['menu' => $menu->id, 'menuitem' => $menuItem->id]) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>

<script>
    function changeOrder(itemId, direction, menuId) {
        fetch(`/admin/menus/${menuId}/reorder`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ itemId, direction })
        })
        .then(response => {
            if (!response.ok) {
         
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.reload(); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
      
            alert('An error occurred while changing the order. Please check the console for more information.');
        });
    }
</script>

@endsection