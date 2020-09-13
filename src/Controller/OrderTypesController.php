<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderTypes Controller
 *
 *
 * @method \App\Model\Entity\OrderType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $orderTypes = $this->paginate($this->OrderTypes);

        $this->set(compact('orderTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Type id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderType = $this->OrderTypes->get($id, [
            'contain' => [],
        ]);

        $this->set('orderType', $orderType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderType = $this->OrderTypes->newEntity();
        if ($this->request->is('post')) {
            $orderType = $this->OrderTypes->patchEntity($orderType, $this->request->getData());
            if ($this->OrderTypes->save($orderType)) {
                $this->Flash->success(__('The order type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order type could not be saved. Please, try again.'));
        }
        $this->set(compact('orderType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderType = $this->OrderTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderType = $this->OrderTypes->patchEntity($orderType, $this->request->getData());
            if ($this->OrderTypes->save($orderType)) {
                $this->Flash->success(__('The order type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order type could not be saved. Please, try again.'));
        }
        $this->set(compact('orderType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderType = $this->OrderTypes->get($id);
        if ($this->OrderTypes->delete($orderType)) {
            $this->Flash->success(__('The order type has been deleted.'));
        } else {
            $this->Flash->error(__('The order type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
