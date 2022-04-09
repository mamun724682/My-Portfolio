<?php

namespace App\DataTables;

use App\Models\Module;
use Yajra\DataTables\Services\DataTable;

class ModuleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('type', function ($data){
                return '<span class="badge bg-danger">'.ucwords($data->type).'</span>';
            })
            ->editColumn('is_single', function ($data){
                return '<span class="badge bg-'.($data->is_single == Module::IS_SINGLE ? 'dark' : 'info').'">'.ucwords($data->is_single == Module::IS_SINGLE ? 'Yes' : 'No').'</span>';
            })
            ->editColumn('status', function ($data){
                return '<span class="badge bg-'.($data->status == Module::STATUS_ACTIVE ? 'success' : 'dark').'">'.ucwords($data->status == Module::STATUS_ACTIVE ? 'Active' : '').'</span>';
            })
            ->addColumn('action', function ($data) {
                $buttons = '';

                $buttons .= '<li><a class="dropdown-item" href="' . route('modules.edit', $data->id) . '" title="Edit"><i class="las la-edit"></i> Edit</a></li>';

                $buttons .= '<li><form action="' . route('modules.destroy', $data->id) . '"  id="delete-form-' . $data->id . '" method="post">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="dropdown-item" onclick="return makeDeleteRequest(event, ' . $data->id . ')"  type="submit" title="Delete"><i class="las la-trash-alt"></i> Delete</form></li>
                                    ';

                $return_data = '
                <div class="dropdown"><a class="dropdown-toggle" data-coreui-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="las la-ellipsis-v" style="font-size: 24px;"></i></a>
                    <ul class="dropdown-menu">
                    '.$buttons.'
                    </ul>
                </div>
                ';
                return $buttons ? $return_data : '';
            })
            ->rawColumns(['action', 'type', 'is_single', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Module $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Module $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => 'auto', 'printable' => false, 'title' => 'ACTION'])
            ->parameters($this->getBuilderParameters());
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'defaultContent' => '',
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => '#SL',
                'render' => null,
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
                'footer' => '',
            ],
            [
                'title' => 'Type',
                'name' => 'type',
                'data' => 'type'
            ],
            [
                'title' => 'Name',
                'name' => 'name',
                'data' => 'name'
            ],
            [
                'title' => 'Is Single',
                'name' => 'is_single',
                'data' => 'is_single'
            ],
            [
                'title' => 'Status',
                'name' => 'status',
                'data' => 'status'
            ],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Modules_' . date('YmdHis');
    }

//    public function pdf()
//    {
//        $excel = app('excel');
//        $data = $this->getDataForExport();
//
//        $pdf = PDF::loadView('vendor.datatables.print', [
//            'data' => $data
//        ]);
//        return $pdf->download($this->getFilename() . '.pdf');
//    }
}
