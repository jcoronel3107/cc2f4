@auth
    @role('Administrador')
    <li>
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-red-600 hover:bg-gray-100">
            🔧 Panel de Administración
        </a>
    </li>
    @endrole
@endauth