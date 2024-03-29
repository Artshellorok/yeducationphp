<?php namespace CooperAV\SmsAero;

use Illuminate\Support\ServiceProvider;
use CooperAV\SmsAero;


class SmsAeroServiceProvider extends ServiceProvider {
  public function boot(){
  	 $this->publishes(array(
            __DIR__.'/config/smsaero.php' => config_path('smsaero.php')
        ));
  }
  public function register()
  {
       $this->app->singleton('smsaero', function () {
            return new SmsAero();
        });
  }
  public function provides()
  {
        return array('smsaero');
  }
}
