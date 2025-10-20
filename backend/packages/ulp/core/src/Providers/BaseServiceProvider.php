<?php

declare(strict_types=1);

namespace Ulp\Core\Providers;

abstract class BaseServiceProvider extends \Illuminate\Support\ServiceProvider {

  /**
   * Ścieżka główna pakietu (ustawiana w konstruktorze dziecka)
   */
  protected string $packagePath;

  /**
   * Nazwa aliasu dla widoków
   */
  protected string $viewsAlias = '';

  /**
   * 
   */
  public function __construct($app, string $viewsAlias) {
    parent::__construct($app);
    $this->packagePath = dirname(new \ReflectionClass(static::class)
      ->getFileName(), 3) . '/';
    $this->viewsAlias = $viewsAlias;
  }

  /**
   * 
   */
  public function register(): void {
    //
  }

  /**
   * 
   */
  public function boot(): void {
    $this->loadRoutesFrom($this->packagePath . 'routes/web.php');
    $this->loadMigrationsFrom($this->packagePath . 'database/migrations');
    $this->loadViewsFrom($this->packagePath . 'resources/views', $this->viewsAlias);
  }

}