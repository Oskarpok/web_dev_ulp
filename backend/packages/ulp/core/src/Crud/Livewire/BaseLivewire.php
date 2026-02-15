<?php
 
namespace Ulp\Core\Crud\Livewire;

/**
 * Universal Livewire form component
 *
 * - Handles dynamic form fields render
 * - Manages form state
 * - Provides validation
 * - Supports HTTP methods (GET, POST, PUT, PATCH)
 */
abstract class BaseLivewire extends \Livewire\Component {
  
  use \Livewire\WithFileUploads;

  protected const ROUTE_NAME = null;

  public array $fields;
  public array $validationRules;
  public array $state = [];

  public string $action;
  public string $httpMethod;
  public string $formId = 'form';
  public bool $enctype = false;

  /**
   * 
   * * @return array List of fields for database record.
   */
  abstract public static function createButtons(): array;
  abstract public static function createFields(): array;
  abstract public static function showButtons(): array;
  abstract public static function showFields(): array;
  abstract public static function editButtons(): array;
  abstract public static function editFields(): array;

  /**
   * Component initialization with converting field objects into Livewire 
   * friendly arrays and initialize form state with default field values
  */ 
  public function mount(array $fields, array $validationRules, string $action, array|object $data, string $httpMethod, string $formId = '') {
    $this->fields = collect($fields)->filter()
      ->map(fn ($field) => $field->toLivewire())
      ->values()->toArray();
    $this->action = $action;
    $this->httpMethod = $httpMethod;
    $this->formId = $formId ?? $this->formId;
    $this->validationRules = $validationRules;

    foreach($this->fields as $field) {
      $this->state[$field['name']] = data_get($data, $field['name']) ?? null;

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