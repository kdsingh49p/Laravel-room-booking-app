 <label><br>
     <strong>Total: <?= $patient->total() ?></strong>
 </label>

 <div class="table-responsive  c-table-responsive">
     <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
         width="100%" style="border: 1px solid #dee2e6;">
         <thead>
             <tr>
                 <th>Sr.No.</th>
                 <th>Patient ID</th>
                 <th>Patient Disease</th>
                 <th>Patient Name</th>
                 <th>Patient Age</th>
                 <th>Patient Mobile</th>
                 <th>Patient Address</th>

                 <th>Actions</th>
             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>Sr.No.</th>
                 <th>Patient ID</th>
                 <th>Patient Disease</th>
                 <th>Patient Name</th>
                 <th>Patient Age</th>
                 <th>Patient Mobile</th>
                 <th>Patient Address</th>
                 <th>Actions</th>

             </tr>
         </tfoot>
         <tbody>

             <?php if (count($patient) > 0): ?>
             <?php
             $sr = $patient->firstItem();
             
             ?>

             @foreach ($patient as $key => $item)
                 <tr>
                     <td class="table-text">
                         {{ $sr }}
                     </td>



                     <td class="table-text">
                         {{ $item->patient_id }}
                     </td>
                     <td class="table-text">
                         {{ $item->get_disease['title'] }}
                     </td>
                     <td class="table-text">
                         {{ $item->patient_name }}
                     </td>
                     <td class="table-text">
                         {{ $item->patient_age }}
                     </td>
                     <td class="table-text">
                         {{ $item->patient_mobile }}
                     </td>
                     <td class="table-text">
                         {{ $item->patient_address }}
                     </td>


                     <td width="150">
                         <a href="{{ url('patient/receipt/') }}/<?= $item->p_id ?>">
                             <i class="fa fa-eye"></i> Print
                         </a>
                         <a target="_blank" href="{{ url('patient/update/') }}/<?= $item->p_id ?>">
                             <i class="fa fa-pencil"></i> Edit
                         </a>
                         <a href="javascript:;" link="{{ url('patient/delete/') }}/<?= $item->p_id ?>"
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

 <?php if (count($patient) > 0): ?>
 {{ $patient->links() }}
 <?php endif ?>
