 <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
 <label><br>
     <strong>Total: <?= $disease->total() ?></strong>
 </label>




 <div class="table-responsive  c-table-responsive">
     <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
         width="100%" style="border: 1px solid #dee2e6;">
         <thead>
             <tr>
                 <th>Sr.No.</th>
                 <th>Disease Name</th>

                 <th>Status</th>
                 <th>Actions</th>
             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>Sr.No.</th>
                 <th>Disease Name</th>
                 <th>Status</th>
                 <th>Actions</th>

             </tr>
         </tfoot>
         <tbody>

             <?php if (count($disease) > 0): ?>

             <?php
             $sr = $disease->firstItem();
             
             ?>

             @foreach ($disease as $key => $item)
                 <tr>
                     <td class="table-text">
                         {{ $sr }}
                     </td>



                     <td class="table-text">
                         {{ $item->title }}
                     </td>
                     <td width="250">

                         <div class="switch">
                             <label>OFF
                                 <input type="checkbox" eid="{{ $item->disease_id }}" name="user_status"
                                     <?= $item->status == 1 ? 'checked' : '' ?>><span
                                     class="lever"></span>ON</label>
                         </div>


                     </td>

                     <td width="150">
                         <a href="javascript:;" class="openDetailModal" eid="{{ $item->disease_id }}">
                             <i class="fa fa-eye"></i> View
                         </a>
                         <a target="_blank" href="{{ url('disease/update/') }}/<?= $item->disease_id ?>">
                             <i class="fa fa-pencil"></i> Edit
                         </a>
                         <a href="javascript:;" link="{{ url('disease/delete/') }}/<?= $item->disease_id ?>"
                             class="delete">
                             <i class="fa fa-trash"></i> Delete
                         </a>
                     </td>





                 </tr>



                 <?php
                 $sr++;
                 ?>
             @endforeach

             <?php endif ?>



         </tbody>
     </table>
 </div>





 <?php if (count($disease) > 0): ?>
 {{ $disease->links() }}
 <?php endif ?>
