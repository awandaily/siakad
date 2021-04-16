
<?php
    
    $id = $_POST["id"];

    if ($id!="") {
        $this->db->where("id_admin", $id);
        $d = $this->db->get("admin")->row_array();

        $owner               = $d["owner"];
        $username            = $d["username"];
        $pass                = substr(substr($d["alias"],0,-2),2);
    }
    else{
        $owner                 = "";
        $username              = "";
        $pass                  = "";
    }

?>

<div class="form-group">
    <label>Nama Petugas</label><br>
    <input type="text" class="form-control" name="f[owner]" autofocus="" required="" value="<?php echo $owner ?>">
</div>
<div class="form-group">
    <label>Username</label><br>
    <input type="text" class="form-control" name="f[username]" autofocus="" required="" value="<?php echo $username ?>">
</div>
<div class="form-group">
    <label>Password</label><br>
    <input type="text" class="form-control" name="password" autofocus="" required="" value="<?php echo $pass ?>">
</div>
 
