<?php

declare(strict_types=1);

namespace Ulp\Core\Traits;

use Illuminate\Http\Request;

trait DefaultModel {

  /**
   * To do add base tabel apend and fillabe and give childer to expand it
   */
  // protected $defaultAppends = [];
  // protected $defaultFillable = [];

  /**
   * Applies query filters based on request input for given columns.
   * This scope allows filtering results dynamically by columns
   * that have matching non-empty inputs in the request.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query The query builder instance.
   * @param \Illuminate\Http\Request $request The HTTP request containing filter criteria.
   * @param array $columns List of column names to filter.
   * @return \Illuminate\Database\Eloquent\Builder The filtered query builder.
   */
  public function scopeFilter($query, Request $request, array $columns) {
    foreach ($columns as $column) {
      if ($request->filled($column)) {
        $query->where($column, 'like', '%' . $request->input($column) . '%');
      }
    }
    return $query;
  }
  
  /**
   * Defines the validation rules for the model's attributes.
   * This method provide specific validation rules for data.
   *
   * @return array Validation rules as an associative array.
   */
  abstract public static function validationRules(): array;

  /**
   * 
   */
  protected function serializeDate(\DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
  }
  
}