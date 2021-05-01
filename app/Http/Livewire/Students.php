<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;

class Students extends Component
{
    public $ids;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $searchTerm;

    public function resetInputField(){
        $this->firstname = '';
        $this->lastname = '';
        $this->email = '';
        $this->phone = '';

    }

    public function store(){
        $validateData = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);
        Student::create($validateData);
        session()->flash('message', 'Student Created successfully!');
        $this->resetInputField();
        $this->emit('studentAdded');
    }

    public function edit($id){
        $student = Student::where('id', $id)->first();
        $this->ids = $student->id;
        $this->firstname = $student->firstname;
        $this->lastname = $student->lastname;
        $this->email = $student->email;
        $this->phone = $student->phone;
    }

    public function update(){
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);
        if($this->ids){
            $student = Student::find($this->ids);
            $student->update([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
            session()->flash('message', 'Student Updated successfully!'); 
            $this->resetInputField();
            $this->emit('studentUpdated');
        }
    }

    public function delete($id){
        if($id){
            Student::where('id', $id)->delete();
            session()->flash('message', 'Student deleted successfully!');
        }
    }

    use WithPagination;
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $students = Student::where('firstname','LIKE', $searchTerm)
                    ->orWhere('lastname','LIKE', $searchTerm)
                    ->orWhere('email','LIKE', $searchTerm)
                    ->orWhere('phone','LIKE', $searchTerm)
                    // ->orderBy('id', 'DESC')->get();
                    ->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.students', ['students'=>$students]);
    }
}
