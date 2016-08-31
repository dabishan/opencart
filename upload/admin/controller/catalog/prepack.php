<?php
class ControllerCatalogPrepack extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/prepack');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/prepack');

		$this->getList();
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

}