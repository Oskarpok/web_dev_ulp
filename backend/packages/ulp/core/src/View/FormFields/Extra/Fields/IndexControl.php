<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra\Fields;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

class IndexControl extends \Ulp\Core\View\FormFields\BaseField {  

  protected array $labels;
  protected array $data;
  protected array $filterable;
  protected string $destinations;
  protected array $resolveButtons;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->resolveButtons = $data['resolveButtons'];
    $this->destinations = $data['destinations'];  
    $this->labels = $data['labels'];
    $this->data = $data['data'] 
      instanceof \Illuminate\Database\Eloquent\Collection 
      ? $data['data']->toArray() : $data['data'];
    foreach ($this->data as &$row) {
      $row['buttons'] = $this->resolveRowButtons($row['id']);
    }
    $this->filterable = $data['filterable'];
  }

  protected function resolveRowButtons($id): array {
    $buttons = [];
    $access = $this->resolveButtons;
    $destinations = $this->destinations;

    if ($access['show']) {
      $buttons[] = ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $destinations . 'show',
        'routeParams' => [$id],
        'style' => 4,
        'icone' => 'fa-solid fa-eye text-sky-400 hover:text-sky-300',
      ]);
    }

    if ($access['edit']) {
      $buttons[] = ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $destinations . 'edit',
        'routeParams' => [$id],
        'style' => 4,
        'icone' => 'fas fa-edit text-yellow-400 hover:text-yellow-300',
      ]);
    }

    if ($access['destroy']) {
      $buttons[] = ButtonsTypeController::make([
        'type' => 'form',
        'routeName' => $destinations . 'destroy',
        'routeParams' => [$id],
        'style' => 4,
        'icone' => 'fas fa-trash-alt',
      ]);
    }

    return $buttons;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.extra.intex';
  }
  
}