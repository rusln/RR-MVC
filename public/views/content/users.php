
<div class="span12">
<table class="table  " >
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>role</th>
        </tr>
    </thead>
    <?php foreach ($this->users as $key=>$value):?>
    
        
    
        <tr>
            
            <td><?php echo $value['id']; ?></td>            
            <td><?php echo $value['name']; ?></td>            
            <td><?php echo $value['email']; ?></td>  
            <td><?php echo $value['role']; ?></td>  
            <td>
                <a href="<?php echo BASE_URL.'users/fetch/'.$value['id'] ?>">
                    <button class="btn btn-primary">Edit</button>
                </a>
            </td>
            <td>
                <a href="<?php echo BASE_URL.'users/delete/'.$value['id'] ?>">
                    <button class="btn btn-danger">Delete</button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>


</div>