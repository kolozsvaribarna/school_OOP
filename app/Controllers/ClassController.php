<?php
namespace App\Controllers;
use App\Models\ClassModel;

use App\Views\Display;

class ClassController extends Controller {

    public function __construct()
    {
        $class = new ClassModel();
        parent::__construct($class);
    }

    public function index(): void
    {
        $classes = $this->model->all(['order_by' => ['year'], 'direction' => ['DESC']]);
        $this->render('classes/index', ['classes' => $classes]);
    }

    public function create(): void
    {
        $this->render('classes/create');
    }
    public function edit(int $id): void
    {
        $class = $this->model->find($id);
        if (!$class) {
            // Handle invalid ID gracefully
            $_SESSION['warning_message'] = "Az osztály a megadott azonosítóval: $id nem található.";
            $this->redirect('/classes');
        }
        $this->render('classes/edit', ['class' => $class]);
    }

    public function save(array $data): void
    {
        if (empty($data['class_name']) || empty($data['year'])) {
            $_SESSION['warning_message'] = "Az mezőt kötelező kitölteni.";
            $this->redirect('/classes/create'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $this->model->class_name = $data['class_name'];
        $this->model->year = $data['year'];
        $this->model->create();
        $this->redirect('/classes');
    }

    public function update(int $id, array $data): void
    {
        $class = $this->model->find($id);
        if (!$class || empty($data['class_name']) || empty($data['year'])) {
            // Handle invalid ID or data
            $this->redirect('/classes');
        }
        $class->class_name = $data['class_name'];
        $class->year = $data['year'];
        $class->update();
        $this->redirect('/classes');
    }

    function show(int $id): void
    {
        $class = $this->model->find($id);
        if (!$class) {
            $_SESSION['warning_message'] = "Az osztály a megadott azonosítóval: $id nem található.";
            $this->redirect('/classes'); // Handle invalid ID
        }
        $this->render('classes/show', ['class' => $class]);
    }

    function delete(int $id): void
    {
        $class = $this->model->find($id);
        if ($class) {
            $result = $class->delete();
            if ($result) {
                $_SESSION['success_message'] = 'Sikeresen törölve';
            }
        }

        $this->redirect('/classes'); // Redirect regardless of success
    }

}
