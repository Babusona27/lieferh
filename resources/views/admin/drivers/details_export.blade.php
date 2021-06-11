<table>
    <thead>
        <tr colspan="4">
            <th><b>Driver Details</b></th>
        </tr>
        <tr>
            <th><b>Name</b></th>
            <th><b>Email</b></th>
            <th><b>Phone</b></th>
            <th><b>Address</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $result['driver_details']->name; ?></td>
            <td><?php echo $result['driver_details']->email; ?></td>
            <td><?php echo $result['driver_details']->user_phone; ?></td>
            <td><?php echo $result['driver_details']->user_address; ?></td>
        </tr>    
    </tbody>
</table>

<br>

<table>
    <thead>
        <tr colspan="6">
            <th><b>Driver Task Details</b></th>
        </tr>
        <tr>
            <th><b>Task Name</b></th>
            <th><b>Task Type</b></th>
            <th><b>Task Date</b></th>
            <th><b>Fare Type</b></th>
            <th><b>Driver's Fare</b></th>
            <th><b>Earning</b></th>
        </tr>
    </thead>
    <tbody>
    @if(count($result['tasks'])>0)
        @foreach ($result['tasks'] as $key=>$tasks)
        <tr>
                                            
            <td>{{ $tasks->task_name }}</td>
            <td><?php if( $tasks->type == 1 ){
                    echo "Regular";
                 }elseif ( $tasks->type == 2 ) {
                    echo "Delevery";
                 }elseif ( $tasks->type == 3 ) {
                    echo "Pickup";
                 }else{
                    echo "no type found";
                 }?></td>
            <td><?php echo date("d-m-Y",strtotime($tasks->task_date)); ?></td>

            <td>
                <?php if( $tasks->drivers_fare_type == 1 ){
                    echo "Per Delivery Amount";
                }elseif ( $tasks->drivers_fare_type == 2 ) {
                    echo "Total Delivery Amount";
                }else{
                    echo "";
                }?>
            </td>

            <td>{{ $tasks->drivers_fare }}</td>
            <td>{{ $tasks->totalEarn }}</td>
        
        </tr>
    @endforeach

      @else
        <tr colspan="6">No records found....</tr>
      @endif
    
    </tbody>
</table>