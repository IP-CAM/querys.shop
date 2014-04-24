<?php
class ModelExtensionModule extends Model {

	public function getModules() {

		$this->load->model('setting/extension');
		
		$files = glob(DIR_APPLICATION . 'controller/module/*.php');
		$extensions = array();
		$installed 	= $this->model_setting_extension->getInstalled('module');

		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');

				$this->language->load('module/' . $extension);

				$action = 'module/' . $extension . '';


				if (in_array($extension, $installed)) {
					$extensions[] = array(
						'name'   => $this->language->get('heading_title'),
						'action' => $action,
						'code'	 => $extension
					);
				}
			}
		}
		return $extensions;
	}
}
?>