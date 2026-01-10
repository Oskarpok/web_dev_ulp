<?php
 
namespace Ulp\Core\Livewire\FormFields;
 
/**
 * Universal Livewire form component
 *
 * - Handles dynamic form fields render
 * - Manages form state
 * - Provides validation
 * - Supports HTTP methods (GET, POST, PUT, PATCH)
 */
class FormComponent extends \Livewire\Component {
  
  use \Livewire\WithFileUploads;

  public array $fields;
  public array $validationRules;
  public array $state = [];

  public string $action;
  public string $httpMethod;
  public string $formId = 'form';
  public bool $enctype = false;

  /**
   * Component initialization with converting field objects into Livewire 
   * friendly arrays and initialize form state with default field values
  */ 
  public function mount(array $fields, array $validationRules, string $action, string $httpMethod, ?string $formId = null) {
    $this->fields = collect($fields)->filter()
      ->map(fn ($field) => $field->toLivewire())
      ->values()->toArray();
    $this->action = $action;
    $this->httpMethod = $httpMethod;
    $this->formId = $formId ?? $this->formId;
    $this->validationRules = $validationRules;

    foreach($this->fields as $field) {
      $this->state[$field['name']] = $field['value'] ?? null;
      if ($field['type'] === 'file') {
        $this->enctype = true;
      }
    }
  }

  // Build Livewire validation rules
  protected function rules(): array {
    return collect($this->validationRules)
      ->mapWithKeys(fn ($rules, $name) => ["state.$name" => $rules])
      ->toArray();
  }

  // replase attribute with more readable names for validation messages
  protected function validationAttributes(): array {
    return collect($this->fields)->mapWithKeys(fn ($field) => [
      'state.' . $field['name'] => $field['label'] ?? $field['name'],
    ])->toArray();
  }

  // validate only the updated field (real-time validation) when blur happens
  public function updated($property) {
    $this->validateOnly($property);
  }

  // determine the actual HTML form method HTML supports only GET and POST
  public function formMethod(): string {
    return in_array($this->httpMethod, ['GET', 'POST'])
      ? $this->httpMethod
      : 'POST';
  }

  // return spoofed method for non HTML methods used with @method() in Blade
  public function spoofedMethod(): ?string {
    return in_array($this->httpMethod, ['GET', 'POST'])
      ? null
      : $this->httpMethod;
  }

  // render the Livewire view
  public function render() {
    return view('core::livewire.form_fields.form', [
      'formId' => $this->formId,
      'action' => $this->action,
      'httpMethod' => $this->httpMethod,
      'fields' => $this->fields,
      'enctype' => $this->enctype,
      'spm' => $this->spoofedMethod(),
    ]);
  }

}