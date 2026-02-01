<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Concerns;
  
use Illuminate\Http\Request;

trait CrudeMethods {

  /**
   * This constant defines the Blade view namespace and directory prefix used 
   * when rendering CRUD (Create, Read, Update, Delete) components in the CORE.
   * 
   * @var string
   */
  protected const CRUD_VIEWS = 'core::components.crud_views.';

  /**
   * The fully qualified class name of the model associated with the controller.
   * This must be set overridden the child controller.
   * 
   * @var string
   */
  protected const MODEL_CLASS = null;

  /**
   * Route name for operations must be overridden in child controllers.
   * 
   * @var string
   */
  protected const ROUTE_NAME = null;

  /**
   * Returns an instance of the model defined in the child controller.
   *
   * @return \Illuminate\Database\Eloquent\Model
   */
  protected function getModelInstance(): \Illuminate\Database\Eloquent\Model {
    return app(static::MODEL_CLASS);
  }

  /**
   * Displays the form view for creating a new record.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(): \Illuminate\View\View {
    return view(self::CRUD_VIEWS . 'create', [
      'title' => $this->titles()['create'] ?? '',
      'controls' => $this->prepareFormFields(),
      'route' => route(static::ROUTE_NAME . 'store'),
      'validationRules' => static::MODEL_CLASS::validationRules(),
    ]);
  }

  /**
   * Handles storing a new record.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request) {
    $this->callHook('beforeValidation', $request);
    $validate =  $request->validate(static::MODEL_CLASS::validationRules());   
    $this->callHook('afterValidation', $request);
    $this->callHook('beforeStore', $validate);
    $this->callHook('afterStore', $validate, static::MODEL_CLASS::create($validate));
    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('success', $this->titles()['recordCreatedSucces'] 
      ?? 'Record has been updated');
  }

  /**
   * Displays the details of a single record.
   *
   * @param  int  $id  The ID of the record to display.
   * @return \Illuminate\Http\Response
   */
  public function show(int $id): \Illuminate\View\View {
    return view(self::CRUD_VIEWS . 'show', [
      'title' => $this->titles()['show'] ?? '',
      'controls' => $this->prepareFormFields(static::MODEL_CLASS::find($id)),
    ]);
  }

  /**
   * Displays a form for editing an existing record.
   *
   * @param  int  $id  The ID of the record to be edited.
   * @return \Illuminate\Http\Response
   */
  public function edit(int $id): \Illuminate\View\View {
    return view(self::CRUD_VIEWS . 'edit', [
      'title' => $this->titles()['edit'] ?? '',
      'route' => route(static::ROUTE_NAME . 'update', $id),
      'controls' => $this->prepareFormFields(static::MODEL_CLASS::find($id)),
      'validationRules' => static::MODEL_CLASS::validationRules(),
    ]);
  }

  /**
   * Updates an existing record identified by its ID.
   *
   * @param \Illuminate\Http\Request $request The request object containing data.
   * @param int $id The ID of the record to update.
   * @return \Illuminate\Http\RedirectResponse Redirects back to the edit form.
   */
  public function update(Request $request, int $id) {
    $record = static::MODEL_CLASS::find($id);

    if($record) {
      $this->callHook('beforeValidation', $request);
      $validate = $request->validate(static::MODEL_CLASS::validationRules($id));
      $this->callHook('afterValidation', $request);
      $this->callHook('beforeUpdate', $validate, $record);
      $record->update($validate);
      $this->callHook('afterUpdate', $validate, $record);
      return redirect()->route(static::ROUTE_NAME . 'index')
        ->with('success', $this->titles()['recordUpdateSucces'] 
        ?? 'Record has been updated');
    }

    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('error', $this->titles()['recordNotFound'] ?? 'Record not found');
  }

  /**
   * Deletes a model record by ID.
   *
   * @param  int  $id  The ID of the record to delete.
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(int $id) {
    $record = static::MODEL_CLASS::find($id);

    if($record) {
      $this->callHook('beforeDestroy', $record);
      $this->callHook('afterDestroy', $record->delete());
      return redirect()->route(static::ROUTE_NAME . 'index')
        ->with('success', $this->titles()['recordDestroySucces'] 
        ?? 'Record has been deleted');
    }

    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('error', $this->titles()['recordNotFound'] ?? 'Record not found');
  }

  /**
   * This method checks whether a method with the given hook name exists in the 
   * current class. If it does, it will be executed with the provided parameters.
   *
   * @param string $hook   The name of the hook/method to call.
   * @param mixed  ...$params  Optional parameters to pass to the hook method.
   * @return void
   */
  protected function callHook(string $hook, ...$params): void {
    if (method_exists($this, $hook)) {
      $this->$hook(...$params);
    }
  }

}