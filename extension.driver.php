<?php

	Class extension_config_to_params extends Extension{
		
		public function getSubscribedDelegates(){
			return array(
				array(
					'page' => '/frontend/',
					'delegate' => 'FrontendParamsResolve',
					'callback' => 'addConfigtoParams'
				),						
			);
		}	
		
        /**
         * Add all the config values into the params object
         */
		public function addConfigtoParams($context){
            
            $data = Symphony::Configuration()->get();
            
            foreach($data['config_to_params'] as $key => $val){
                $context['params'][$key] = $val;
            }
		}	
        
        /**
         * Install Config to Params
         * Add blank settings section to use
         * @return void
         */
        public function install()
        {
            Symphony::Configuration()->set('example-data', 'example-value', 'config_to_params');
            Symphony::Configuration()->write();
            
        }
        
        /**
         * On uninstall, delete the config_to_params section
         */
        public function uninstall()
        {
            Symphony::Configuration()->remove('config_to_params', 'config_to_params');
            Symphony::Configuration()->write();
        }
			
	}