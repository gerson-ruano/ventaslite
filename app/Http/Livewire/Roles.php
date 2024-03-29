<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class Roles extends Component

{

    use WithPagination;

    public $roleName, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }


    public function render()
    {

        if(strlen($this->search) > 0)
        $roles = Role::where('name','like', '%' . $this->search . '%')->paginate($this->pagination);
    else
        $roles = Role::orderBy('name', 'asc')->paginate($this->pagination);


        return view('livewire.roles.component', [
            'roles' => $roles
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function CreateRole()
    {
        $rules = ['roleName' => 'required|min:2|unique:roles,name'];

        $messages = [
            'roleName.required' => 'Él nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El nombre del role debe tener como minimo 2 caracteres'
        ];

        $this->validate($rules, $messages);

        Role::create([
            'name' => $this->roleName
        ]);

        $this->emit('role-added','Se registro el role con exito');
        $this->resetUI();
    }

    public function Edit(Role $role)
    {
        //$role = Role::find($id);
        $this->selected_id = $role->id;
        $this->roleName = $role->name;

        $this->emit('show-modal', 'Show modal');
    }

    public function UpdatedRole()
    {
        $rules = ['roleName' => "required|min:2|unique:roles,name, {$this->selected_id}"];

        $messages = [
            'roleName.required' => 'Él nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El nombre del role debe tener como minimo 2 caracteres'
        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        $role->save();

        $this->emit('role-updated','Se actualizó el role con exito');
        $this->resetUI();

    }

    protected $listeners = ['destroy' => 'Destroy'];

    public function Destroy($id)
    {
        $permissionCount = Role::find($id)->permissions->count();
        if($permissionCount > 0)
        {
            $this->emit('role-error', 'No se puede eliminar el role porque tiene permisos asociados');
            return;
        }

        Role::find($id)->delete();
        $this->emit('role-deleted','Se elimino el role con exito');

    }

    public function AsignarRoles($rolesList)
    {
        if($this->userSelected > 0)
        {
            $user = User::find($this->userSelected);
            if($user){
                $user->syncRoles($rolesList);
                $this->emit('msg-ok','Roles asignados correctamente');
                $this->resetInput();
            }
        }
    }

    public function resetUI()
    {
        $this->roleName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
