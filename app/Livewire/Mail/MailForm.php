<?php

namespace App\Livewire\Mail;


use App\Mail\Custom\CustomMail;
use App\Repository\Form\MailHistory;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class MailForm extends Component
{
    use WithFileUploads;
    public $form;
    public $file1;
    public $file2;
    public $file3;

    public function mount()
    {
        $this->form = form_model(MailHistory::class);
    }
    public function create()
    {

        $data = [
            'title'=>$this->form['title'],
            'content'=>$this->form['content'],
            'file'=>[]
        ];
        $fileAttach = "";
        if ($this->file1!=null){
            $filename = $this->file1->storeAs('public/mail-attachement', $this->file1->getClientOriginalName());
            $data['file'][]= public_path(str_replace('public/','storage/',$filename));
            $this->file1=null;
            $fileAttach.=asset(str_replace('public/','storage/',$filename)).';';
        }
        if ($this->file2!=null){
            $filename = $this->file2->storeAs('public/mail-attachement', $this->file2->getClientOriginalName());
            $data['file'][]= public_path(str_replace('public/','storage/',$filename));
            $this->file2=null;
            $fileAttach.=asset(str_replace('public/','storage/',$filename)).';';
        }
        if ($this->file3!=null){
            $filename = $this->file3->storeAs('public/mail-attachement', $this->file3->getClientOriginalName());
            $data['file'][]= public_path(str_replace('public/','storage/',$filename));
            $this->file3=null;
            $fileAttach.=asset(str_replace('public/','storage/',$filename)).';';
        }


        MailHistory::create([
            'type_mail'=>'custom',
            'model_type'=>null,
            'model_id'=>null,
            'mail'=>$this->form['mail'],
            'title'=>$this->form['title'],
            'content'=>$this->form['content'],
            'attachment' => $fileAttach
        ]);

        Mail::to($this->form['mail'])->send(new CustomMail($data));
        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title' => 'email telah terkirim',
        ]);
        $this->form = form_model(MailHistory::class);



    }
    public function render()
    {
        return view('livewire.mail.mail-form');
    }
}
