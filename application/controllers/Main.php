<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($tableNum)
    {
        $data['title']          = "Milou Farm House";
        $data['transaction']    = $this->M_Global->getDataWhere("Transaction", "TableNumber", $tableNum)->result_array();
        $data['table']          = $tableNum;

        foreach ($data['transaction'] as $value) {
            $statusTrans    = $value['StatusTransaction'];
            if ($statusTrans != 5) {
                $transNum   = $value['TransactionNumber'];
                redirect("milou-add-order/" . $tableNum);
            }
        }
        $this->render_page('main/page-start/index', $data);
    }

    public function update($tableNum)
    {
        $data['title']          = "Milou Farm House";
        $data['transaction1']   = $this->M_Global->getDataWhere("Transaction", "TableNumber", $tableNum)->result_array();

        foreach ($data['transaction1'] as $value) {
            $statusTrans    = $value['StatusTransaction'];
            if ($statusTrans != 5) {
                $transNum   = $value['TransactionNumber'];
            }
        }
        $data['transaction2']   = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();

        $this->render_page('main/page-update/index', $data);
    }

    public function login($transNum)
    {
        $data['transaction']    = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();
        $transNum               = $data['transaction']['TransactionNumber'];
        $tableNum               = $data['transaction']['TableNumber'];
        $phoneNum               = $data['transaction']['PhoneNumber'];
        $transNumber            = $this->input->post("transNum");
        $table                  = $this->input->post("tableNum");
        $phone                  = $this->input->post("phone");

        foreach ($data['transaction'] as $value) {
            $statusTrans    = $value['StatusTransaction'];
            if ($statusTrans != 5 && $phone == $phoneNum && $table == $tableNum && $transNumber == $transNum) {
                redirect("menu-order/" . $transNum);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible mb-1" role="alert">Wrong phone number!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        redirect("milou-add-order/" . $tableNum);
    }

    public function menu($transNum)
    {
        $data['title']          = "Milou Farm House";
        $data['transaction']    = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();

        $this->render_page('main/page-home/index', $data);
    }

    public function cart($transNum)
    {
        $data['title']          = "Milou Farm House";
        $data['transaction']    = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();

        $this->render_page('main/page-cart/index', $data);
    }

    public function getCategory()
    {
        $menuStatusShow     = 1;
        $result             = $this->M_Global->getDataGroupBy("MenuReadyOrder", "MenuStatusShow", "CategoryName", $menuStatusShow)->result_array();

        echo json_encode($result);
    }

    public function getMenu()
    {
        $menuStatusShow     = 1;
        $result             = $this->M_Global->getDataWhereOrderByASC("MenuReadyOrder", "MenuStatusShow", "MenuName", $menuStatusShow)->result_array();

        echo json_encode($result);
    }

    public function getTransactionDetail($transNum)
    {
        $checkTrans             = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();
        $idTrans                = $checkTrans['TransactionID'];
        $data['transDetail']    = $this->M_Global->getDataWhere("TransactionDetail", "TransactionID", $idTrans)->result_array();

        $addOn = [];

        foreach ($data['transDetail'] as $value) {
            $idMenu = $value['MenuID'];
            $addOn  = $this->M_Global->query("SELECT * FROM MenuReadyOrder WHERE MenuID = '$idMenu' ")->result_array();

            foreach ($addOn as $items) {
                $dataMenu[] = array(
                    'MenuID'    => $items['MenuID'],
                    'MenuCode'  => $items['MenuCode'],
                    'MenuType'  => $items['MenuType']
                );
            }
        }
        $data['menu'] = $dataMenu;

        echo json_encode($data);
    }

    public function getMenuAddOn()
    {
        $menuId     = $this->input->post("menuId");
        $menuType   = "Main";
        $addOn      = $this->M_Global->getData2WhereAnd("MenuReadyOrder", "MenuType", "MenuID", "'$menuType'", $menuId)->result_array();

        $id         = $addOn[0]['AddOn'];
        $decode     = json_decode($id);
        $addOn      = [];

        foreach ($decode as $key) {
            $getMenuCode       = $this->M_Global->query("SELECT * FROM MenuReadyOrder WHERE MenuCode = '$key'")->result_array();

            foreach ($getMenuCode as $value) {
                $addOn[] = array(
                    'MenuID'    => $value['MenuID'],
                    'MenuName'  => $value['MenuName'],
                    'MenuImage' => $value['MenuImage'],
                    'MenuPrice' => $value['Price'],
                    'MenuType'  => $value['MenuType']
                );
            }
        }
        $result = $addOn;

        echo json_encode($result);
    }

    public function getTransDetailForNotes()
    {
        $idTransDetail  = $this->input->post("id");
        $transDetail    = $this->M_Global->getDataWhere("TransactionDetail", "TransactionDetailID", $idTransDetail)->result_array();

        echo json_encode($transDetail);
    }

    public function addOnMenu($transNum)
    {
        $checkTrans         = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->result_array();
        $idTransaction      = $checkTrans[0]["TransactionID"];
        $menuId             = $this->input->post('menuIdAddOn');
        $menuCreated        = date('Y-m-d H:i:s', strtotime('now'));

        for ($i = 0; $i < sizeof($menuId); $i++) {
            $idMenu     = $menuId[$i];
            $menuGet    = $this->M_Global->query("SELECT * FROM MenuReadyOrder WHERE MenuID = '$idMenu' ")->result_array();

            $data = array(
                'TransactionID'         => $idTransaction,
                'MenuID'                => $idMenu,
                'MenuName'              => $menuGet[0]['MenuName'],
                'MenuImage'             => '',
                'Price'                 => $menuGet[0]['MenuPrice'],
                'Qty'                   => 1,
                'PriceAfterDiscount'    => '',
                'NoteDetail'            => '',
                'created_at'            => $menuCreated[$i]
                // $menuGet[0]['MenuImage']
            );
            $result = $this->M_Global->insert($data, "TransactionDetail");
        }
        echo json_encode($result);
    }

    public function addCustomer()
    {
        $tableNum           = $this->input->post("tableNum");
        $customerName       = $this->input->post("name");
        $phoneNumber        = $this->input->post("phone");
        $transactionNumber  = $this->M_Global->transactionNumber();

        $data = array(
            'CustomerName'          => $customerName,
            'PhoneNumber'           => $phoneNumber,
            'TransactionNumber'     => $transactionNumber,
            'TableNumber'           => $tableNum,
            'TransactionType'       => 1,
            'TransactionDatetime'   => date('Y-m-d H:i:s', strtotime('now')),
            'created_at'            => date('Y-m-d H:i:s', strtotime('now'))
        );

        $this->M_Global->insert($data, "Transaction");

        redirect("menu-order/" . $transactionNumber);
    }

    public function addToCart($transNum)
    {
        $checkTrans     = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();
        $idTrans        = $checkTrans['TransactionID'];
        $idMenu         = $this->input->post('id');
        $menu           = $this->M_Global->getDataWhere("MenuReadyOrder", "MenuID", $idMenu)->row_array();

        $menuName       = $menu['MenuName'];
        $menuImage      = $menu['MenuImage'];
        $menuPrice      = $menu['MenuPrice'];

        $data = array(
            'TransactionID'         => $idTrans,
            'MenuID'                => $idMenu,
            'MenuName'              => $menuName,
            'MenuImage'             => '',
            'Price'                 => $menuPrice,
            'Qty'                   => 1,
            'PriceAfterDiscount'    => '',
            'NoteDetail'            => '',
            'created_at'            => date('Y-m-d H:i:s', strtotime('now'))
        );
        $result = $this->M_Global->insert($data, "TransactionDetail");

        echo json_encode($result);
    }

    public function destroyItems()
    {
        $idTransDetail  = $this->input->post("id");
        $result         = $this->M_Global->delete("TransactionDetail", array("TransactionDetailID" => $idTransDetail));

        echo json_encode($result);
    }

    public function countCart($transNum)
    {
        $checkTrans     = $this->M_Global->getDataWhere("Transaction", "TransactionNumber", $transNum)->row_array();
        $idTrans        = $checkTrans['TransactionID'];
        $transDetail    = $this->M_Global->getDataWhere("TransactionDetail", "TransactionID", $idTrans)->result_array();

        echo json_encode($transDetail);
    }

    public function incdec()
    {
        $idTransDetail      = $this->input->post("id", TRUE);
        $qty                = $this->input->post("qty", TRUE);

        $data = array(
            'Qty'           => $qty
        );
        $result = $this->M_Global->update("TransactionDetail", $data, array("TransactionDetailID" => $idTransDetail));

        echo json_encode($result);
    }

    public function addNotes()
    {
        $idTransDetail  = $this->input->post("transId");
        $notes          = $this->input->post('notes');

        $data = array(
            'NoteDetail'    => $notes,
            'update_at'     => date('Y-m-d H:i:s', strtotime('now'))
        );
        $result = $this->M_Global->update("TransactionDetail", $data, array("TransactionDetailID" => $idTransDetail));

        echo json_encode($result);
    }

    public function findMenu()
    {
        $menuStatusShow = 1;
        $query  = "";

        if ($this->input->post("query")) {
            $query = $this->input->post("query");
        }
        $result = $this->M_Global->findData("MenuReadyOrder", "MenuStatusShow", "MenuName", "MenuName", $query, $menuStatusShow)->result();

        echo json_encode($result);
    }

    public function confirmOrder()
    {
        $transDetailId      = $this->input->post("id");
        $updated_at         = date('Y-m-d H:i:s', strtotime('now'));

        for ($i = 0; $i < sizeof($transDetailId); $i++) {
            $id             = $transDetailId[$i];
            $transDetail    = $this->M_Global->query("SELECT * FROM TransactionDetail WHERE TransactionDetailId = '$id' AND StatusForKitchen = 0")->result_array();

            $data = array(
                'StatusForKitchen'  => 1,
                'update_at'         => $updated_at
            );
            $result = $this->M_Global->update("TransactionDetail", $data, array("TransactionDetailID" => $id));

            echo json_encode($result);
        }
    }
}
