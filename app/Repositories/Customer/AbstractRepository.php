<?php
namespace App\Repositories\Customer;

use Illuminate\Support\Facades\DB;

abstract class AbstractRepository
{
	public function all($ordervalue = null, $sortorder = null, $columns = array('*'))
	{
		$order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
		return $this->query->orderBy($order,$sort)->get($columns);
	}

	public function paginate($limit = null, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
        $order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
        $limit = is_null($limit) ? 15 : $limit;
        return $this->query->orderBy($order,$sort)->paginate($limit, $columns);
    }

    public function paginateWhere($limit = null, $sql, $array, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
        $order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
        $limit = is_null($limit) ? 15 : $limit;
        return $this->query->whereRaw($sql, $array)->orderBy($order,$sort)->paginate($limit, $columns);
    }

    public function existCreate(array $attributes)
    {
        return $this->query->firstOrCreate($attributes);
    }

    public function create(array $attributes)
    {
        return $this->query->create($attributes);
    }

    public function updateCreate(array $attributes, $field, $value)
    {
        $model = $this->query->where($field, $value)->first();
        $count = $this->query->where($field, $value)->count();
        if($count){
            $model->fill($attributes);
            return $model->save();
        }
        return $this->query->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $model = $this->query->find($id);
        $model->fill($attributes);
        if($model->save()){
            return 1;
        }
        return $model->save();
    }

    public function delete($id)
    {
        $model = $this->query->find($id);
        $model->delete();
        return 1;
    }

    public function updateRaw(array $attributes, $field, $value)
    {
        $model = $this->query->where($field, $value)->first();
        $model->fill($attributes);
        if($model->save()){
            return 1;
        }
        return $model->save();
    }

    public function with(array $relations, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
        $order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
        return $this->query->with($relations)->orderBy($order,$sort)->get($columns);
    }

    public function find($id, $columns = array('*'))
    {
        return $this->query->find($id, $columns);
    }

    public function findWith($id, array $relations, $columns = array('*'))
    {
        return $this->query->with($relations)->where('id', $id)->first();
    }

    public function findByWith($field, $value, array $relations, $columns = array('*'))
    {
        return $this->query->with($relations)->where($field, $value)->first();
    }

    public function findByField($field, $value)
    {
        return $this->query->where($field,'=',$value)->first();
    }

    public function rawByFieldAll($sql, $array)
    {
    	return $this->query->whereRaw($sql, $array)->get();
    }

    public function getWhereIn($field, array $array, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
    	$order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
    	return $this->query->whereIn($field, $array)->orderBy($order,$sort)->get($columns);
    }

    public function getWhereNotIn($field, array $array, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
    	$order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
    	return $this->query->whereNotIn($field, $array)->orderBy($order,$sort)->get($columns);
    }

    public function rawByWithField($relations, $sql, $array)
    {
    	return $this->query->with($relations)->whereRaw($sql, $array)->first();
    }

    public function rawByWithFieldAll($relations, $sql, $array)
    {
    	return $this->query->with($relations)->whereRaw($sql, $array)->get();
    }

    public function rawByWithFieldWhereIn($relations, $field, $value)
    {
    	return $this->query->with($relations)->whereIn($field, $value)->get();
    }

    // public function rawByFieldAllWith($relations, $sql, $array)
    // {
    //     return $this->query->with($relations)->where($sql, $array)->get();
    // }

    public function rawByField($sql, $array)
    {
    	return $this->query->whereRaw($sql, $array)->first();
    }

    public function rawAll($sql, $array, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
    	$order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
    	return $this->query->whereRaw($sql, $array)->orderBy($order,$sort)->get($columns);
    }

    public function rawAllLimit($sql, $array, $limit, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
        $order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
        return $this->query->whereRaw($sql, $array)->orderBy($order,$sort)->limit($limit)->get($columns);
    }

    public function rawWith(array $relations, $sql, $array, $ordervalue = null, $sortorder = null, $columns = array('*'))
    {
        $order = is_null($ordervalue) ? 'id' : $ordervalue;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
        return $this->query->with($relations)->whereRaw($sql, $array)->orderBy($order,$sort)->get($columns);
    }

    public function rawCount($sql, $array)
    {
        return $this->query->whereRaw($sql, $array)->count();
    }

    public function getCount()
    {
        return $this->query->count();
    }

    public function selectlist($column_name, $column_id, $sortorder = null)
    {
        $order = is_null($column_id) ? 'id' : $column_id;
        $sort = is_null($sortorder) ? 'asc' : $sortorder;
        return [''=>'--']+$this->query->orderBy('name',$sort)->pluck($column_name,$column_id)->toArray();
    }

    public function deleteRaw($sql, $array)
    {
        return $this->query->whereRaw($sql, $array)->delete();
    }

    public function querySelect($sql)
    {
        $results = DB::connection('client')->select($sql);
        return $results;
    }

    public function queryTable()
    {
        return $this->query;
    }
}