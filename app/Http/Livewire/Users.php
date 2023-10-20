<?php

namespace App\Http\Livewire;
use App\Models\Sale;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;

class Users extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $name, $phone, $email, $status, $image, $password, $selected_id, $fileLoaded, $profile;
    public $pageTitle, $componentName, $search, $perfilSeleccionado;

    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status = 'Elegir';
    }
    public function render()
    {
       
    $query = User::query();

    if (!empty($this->perfilSeleccionado)) {
        $query->where('profile', $this->perfilSeleccionado);
    }

    if (strlen($this->search) > 0) {
        $query->where('name', 'like', '%' . $this->search . '%');
    }

    $data = $query->select('*')->orderBy('name', 'asc')->paginate($this->pagination);

    return view('livewire.users.component', [
        'roles' => Role::orderBy('name', 'asc')->get(),
        'data' => $data,
    ])->extends('layouts.theme.app')
      ->section('content');

    }


    public function seleccionarPerfil(){
            $query = User::query();

        if (!empty($this->perfilSeleccionado)) {
            $query->where('profile', $this->perfilSeleccionado);
        }

        $this->usuariosFiltrados = $query->orderBy('name', 'asc')->paginate($this->pagination);
    }

    public function resetUI()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->image = '';
        $this->search = '';
        $this->status = 'Elegir';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
        
    } 


    public function edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password = '';

        $this->emit('show-modal','open!');
    }

    protected $listeners = [
        'destroy' => 'Destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'phone' => 'max:8',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Ingresa el nombre',
            'name.min' => 'El nombre del usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingresa un correo',
            'email.email' => 'Ingresa un correo valido',
            'phone.min' => 'Ingrese un numero valido',
            'phone.max' => 'El numero telefonico debe tener 8 digitos',
            'email.unique' => 'El email ya existe en sistema',
            'status.required' => 'Selecciona el status del usuario',
            'status.not_in' => 'Selecciona el status',
            'profile.required' => 'Selecciona el Perfil/Rol del usuario',
            'profile.not_in' => 'Selecciona el Perfil/Rol distinto a elegir',
            'password.required' => 'Ingresa el Password',
            'password.min' => 'El password debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        $user->syncRoles($this->profile);

        if($this->image)
        {
            $customFileName = uniqid() . ' _.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }
        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado');
 
    }

    public function Update()
    {
        $rules = [
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Ingresa el nombre',
            'name.min' => 'El nombre del usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingresa un correo',
            'email.email' => 'Ingresa un correo valido',
            'email.unique' => 'El email ya existe en sistema',
            'status.required' => 'Selecciona el status del usuario',
            'status.not_in' => 'Selecciona el status',
            'profile.required' => 'Selecciona el Perfil/Rol del usuario',
            'profile.not_in' => 'Selecciona el Perfil/Rol distinto a elegir',
            'password.required' => 'Ingresa el Password',
            'password.min' => 'El password debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        $user->syncRoles($this->profile);

        if($this->image)
        {
            $customFileName = uniqid() . ' _.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;

            $user->image = $customFileName;
            $user->save();

            if($imageTemp != null)
            {
                if(file_exists('storage/users/' . $imageTemp))
                {
                    unlink('storage/users/' . $imageTemp);
                }
            }

        }
        $this->resetUI();
        $this->emit('user-updated', 'Usuario Actualizado');
 
    }

    public function Destroy(User $user)
    {
        if($user)
        {
            $sales = Sale::where('user_id', $user->id)->count();
            if($sales > 0)
            {
                $this->emit('user-whithsales','No es posible eliminar el usuario porque tiene ventas registradas');
            }else{
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted','Usuario Eliminado');
            }
        }
    }
}