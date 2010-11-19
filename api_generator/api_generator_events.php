<?php
	final class ApiGeneratorEvents extends AppEvents{
		public function onSetupConfig($event, $data = null) {
			exit;
			Configure::load('api_generator.config');
		}

		public function  onRequireDatabaseConfigs($event) {
			return array(
				'infinitasapi' => Configure::read('ApiGenerator.config')
			);
		}
	}