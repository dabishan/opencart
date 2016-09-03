<?php
class ControllerCatalogPrepack extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/prepack');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/prepack');

		$this->getList();
	}

	public function add(){
	    $this->load->language('catalog/prepack');

	    $this->document->setTitle($this->language->get('heading_title'));

	    $this->load->model('catalog/prepack');

	    if (($this->request->server['REQUEST_METHOD']== 'POST') && ($this->validateForm())) {
	    	$this->model_catalog_prepack->addPrepack($this->request->post);

	    	$this->session->data['success'] = $this->language->get('text_success');

	    	$url = '';

	    	if (isset($this->request->get['sort'])) {
	    		$url .= '&sort=' . $this->request->get['sort'];
	    	}

	    	if (isset($this->request->get['order'])) {
	    		$url .= '&order=' . $this->request->get['order'];
	    	}

	    	if (isset($this->request->get['page'])) {
	    		$url .= '&sort=' . $this->request->get['sort'];
	    	}

	    	$this->response->redirect($this->url->link('catalog/prepack', 'token=' . $this->session->data['token'] . $url, true));
	    }

	    $this->getForm();
    }

    public function edit() {
    	$this->load->language('catalog/prepack');

    	$this->document->setTitle($this->language->get('heading_title'));

    	$this->load->model('catalog/prepack');

    	if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
    		$this->model_catalog_prepack->editPrepack($this->request->get['prepack_id'], $this->request->post);

    		$this->session->data['success'] = $this->language->get('text_success');

    		$url = '';

    		if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/prepack', 'token=' . $this->session->data['token'] . $url, true));

    	}

        $this->getForm();
    }

    public function delete() {
        $this->load->language('catalog/prepack');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/prepack');

        if(isset($this->request->post['selected'])) {
            foreach($this->request->post['selected'] as $prepack_id){
                $this->model_catalog_prepack->deletePrepack($prepack_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');
            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('catalog/prepack',
                'token=' . $this->session->data['token'] . $url, true));

        }

        $this->getList();

    }

    protected function getForm(){
    	$data['heading_title'] = $this->language->get('heading_title');

    	$data['text_form'] = !isset($this->request->get['prepack_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
    	$data['text_options'] = $this->language->get('text_options');

    	$data['entry_name'] = $this->language->get('entry_name');
    	$data['entry_description'] = $this->language->get('entry_description');
    	$data['entry_sort_order'] = $this->language->get('entry_sort_order');
    	$data['entry_option_value'] = $this->language->get('entry_option_value');
    	$data['entry_quantity'] = $this->language->get('entry_quantity');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_option_value_add'] = $this->language->get('button_option_value_add');
        $data['button_remove'] = $this->language->get('button_remove');

    	if(isset($this->error['warning'])) {
    		$data['error_warning'] = $this->error['warning'];
    	} else {
    		$data['error_warning'] = '';
    	}

    	if(isset($this->error['name'])) {
    		$data['error_name'] = $this->error['name'];
    	} else {
    		$data['error_name'] = '';
    	}

    	if(isset($this->error['description'])) {
    		$data['error_description'] = $this->error['description'];
    	} else {
    		$data['error_description'] = '';
    	}

    	if(isset($this->error['empty_prepack'])) {
    		$data['error_empty_prepack'] = $this->error['empty_prepack'];
    	} else {
    		$data['error_empty_prepack'] = '';
    	}

    	if(isset($this->error['invalid_quantity'])) {
    		$data['error_invalid_quantity'] = $this->error['invalid_quantity'];
    	} else {
    		$data['error_invalid_quantity'] = '';
    	}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/prepack', 'token=' . $this->session->data['token'], true)
			);

		if(!isset($this->request->get['prepack_id'])){
			$data['action'] = $this->url->link('catalog/prepack/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/prepack/edit', 'token=' . $this->session->data['token'] .'&prepack_id='. $this->request->get['prepack_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/prepack', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['prepack_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
		    $prepack_info = $this->model_catalog_prepack->getPrepack($this->request->get['prepack_id']);


        }

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();


		if(isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else if(!empty($prepack_info)) {
			$data['name'] = $prepack_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['prepack_description'])) {
			$data['prepack_description'] = $this->request->post['prepack_description'];
		} else if (!empty($this->request->get['prepack_id'])) {
			$data['prepack_description'] = $this->model_catalog_prepack->getPrepackDescriptions($this->request->get['prepack_id']);
		} else {
			$data['prepack_description'] = array();
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} else if (!empty($prepack_info)) {
			$data['sort_order'] = $prepack_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		//$this->model->load('catalog/option');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/prepack_form', $data));
	}

	protected function getList() {
		if(isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.name';
		}

		if(isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if(isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .='&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .='&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .='&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array (
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array (
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/prepack', 'token=' . $this->session->data['token'], 'SSL')
			);

		$data['add'] = $this->url->link('catalog/prepack/add', 'token='. $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/prepack/delete', 'token='. $this->session->data['token'] . $url, 'SSL');

		$data['prepacks'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page-1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
			);

		$prepack_total = $this->model_catalog_prepack->getTotalPrepacks();

		$results = $this->model_catalog_prepack->getPrepacks($filter_data);

		foreach ($results as $result) {
			$data['prepacks'][] = array(
				'prepack_id' => $result['prepack_id'],
				'name'       => $result['name'],
				'desc'       => $result['desc'],
				'sort_order' => $result['sort_order'],
				'edit'       => $this->url->link('catalog/prepack/edit', 'token=' . $this->session->data['token'] . '&prepack_id=' . $result['prepack_id'] . $url, 'SSL')
				);
        }
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_list'] = $this->language->get('text_list');
			$data['text_add']  = $this->language->get('text_add');
			$data['text_edit'] = $this->language->get('text_edit');
            $data['text_no_results'] = $this->language->get('text_no_results');
            $data['text_confirm'] = $this->language->get('text_confirm');

			$data['column_name'] = $this->language->get('column_name');
			$data['column_sort_order'] = $this->language->get('column_sort_order');
			$data['column_action'] = $this->language->get('column_action');

			$data['button_add'] = $this->language->get('button_add');
			$data['button_edit'] = $this->language->get('button_edit');
			$data['button_delete'] = $this->language->get('button_delete');


        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/prepack', 'token=' . $this->session->data['token'] . '&sort=p.name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/prepack', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		} 

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $prepack_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/prepack', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($prepack_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($prepack_total - $this->config->get('config_limit_admin'))) ? $prepack_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $prepack_total, ceil($prepack_total / $this->config->get('config_limit_admin')));
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/prepack_list.tpl', $data));
	}

	protected function validateForm() {
		if(!$this->user->hasPermission('modify','catalog/prepack')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['prepack_description'] as $language_id => $value) {
			if(utf8_strlen($value['description']) < 3 || utf8_strlen($value['description'] > 255)) {
				$this->error['description'][$language_id] = $this->language->get('error_description');
			}
		}

		if(isset($this->request->post['name'])) {
			if( utf8_strlen($this->request->post['name']) < 3 || utf8_strlen($this->request->post['name'] > 64)) {
				$this->error['name'] = $this->language->get('error_name');
			}
		}

		return !$this->error;
	}
}