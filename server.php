<?php

    class Controler{
        private $db;
        function __construct()
        {
            $this->db = new mysqli('localhost','root','','z_db');
            if (isset($_POST)){
                if ($_POST['a'] == "search"){
                    $this->search();
                }elseif ($_POST['a'] == "search1"){
                    $this->search1();
                }elseif ($_POST['a'] == "delete"){
                    $this->delete();
                }
            }

        }
//////// start search ////////////////////////
        function search(){
            $data = $this->db->query("SELECT * FROM employee")->fetch_all(true);
            print json_encode($data);
        }
////////// my search /////////////
        function search1(){
            $inputVal = $_POST['inputVal'];
            $data = $this->db->query("SELECT * FROM employee WHERE name LIKE '$inputVal%'")->fetch_all(true);
            print json_encode($data);
        }

        function delete(){
            $trId = $_POST['trId'];
            $this->db->query("DELETE  FROM employee WHERE id= '$trId'");
        }


    }
    $opp = new Controler();