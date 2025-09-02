 <div class="row">
     <div class="col-12">
         <div class="card">
             <div class="card-header d-flex flex-wrap align-items-center gap-2">
                 <h4 class="header-title me-auto">Transactions</h4>
             </div>
             <div class="card-body">
                 @if ($transactions->count() > 0)
                     <div class="table-responsive">
                         <table id="myTable" class="table table-bordered">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Reference ID</th>
                                     <th>Direction</th>
                                     <th>Type</th>
                                     <th>Amount</th>
                                     <th>Date</th>
                                     <th>Status</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($transactions as $index => $transaction)
                                     <tr>
                                         <td>{{ $index + 1 }}</td>
                                         <td>{{ $transaction->reference_id }}</td>
                                         <td>
                                             {!! $transaction->direction->badge() !!}
                                         </td>
                                         <td>
                                             {{ $transaction->type->label() }}
                                         </td>
                                         <td>{{ currency($transaction->user->currency) }}{{ formatAmount($transaction->amount) }}
                                         </td>
                                         <td>
                                             {{ date('d M Y, h:i:s A', strtotime($transaction->transaction_at)) }}
                                         </td>
                                         <td>
                                             {!! $transaction->status->badge() !!}
                                         </td>
                                         <td>
                                             <a href="{{ route('user.transaction.show', $transaction->uuid) }}"
                                                 class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                                                 <i class="ti ti-eye"></i></a>
                                             <a onclick="return confirm('Download PDF?')"
                                                 href="{{ route('user.transaction_receipt.download', $transaction->uuid) }}"
                                                 target="_blank"
                                                 class="btn btn-soft-primary btn-icon btn-sm rounded-circle">
                                                 <i class="ti ti-pdf"></i></a>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 @else
                     <div class="text-center">
                         <div class="avatar avatar-md mx-auto mb-2">
                             <div class="avatar-title bg-soft-primary text-primary rounded-circle">
                                 <i class="ti ti-currency-dollar font-size-24"></i>
                             </div>
                         </div>
                         <h5 class="font-size-15 text-muted">No Transaction Found</h5>
                     </div>
                 @endif
             </div> <!-- End Card-body -->
         </div> <!-- end card-->
     </div> <!-- end col-->
 </div>
 <!-- end row -->
