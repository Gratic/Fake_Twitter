<?php
class Model
{
	public static function all()
	{
		$class = strtolower(get_called_class());
		$statement = "select * from $class";
		$statement = db()->query($statement);

		$os = [];
		foreach ($statement as $row) {
			$o = new $class();
			$o->fillAttributes($row);
			$os[] = $o;
		}

		return $os;
	}

	public static function load($id)
	{
		$class = strtolower(get_called_class());
		$id_key = strtolower($class)."_id";
		$statement = "select * from $class where $id_key = :id";
		$statement = db()->prepare($statement);
		$statement->execute(["id" => $id]);

		$o = new $class();
		$o->fillAttributes($statement->fetch());
		return $o;
	}

	public function create()
	{
		$class = strtolower(get_called_class());
		$attributes = get_object_vars($this);
		$id_key = strtolower($class)."_id";

		unset($attributes[$id_key]);

		$statement = "insert into $class ";
		$statement .= "(". implode(",", array_keys($attributes)) .") ";
		$statement .= "values(:".implode(", :",array_keys($attributes)) .")";

		$statement = db()->prepare($statement);
		$statement->execute($attributes);
		return $statement->rowCount();
	}

	public function save()
	{
		$class = strtolower(get_called_class());
		$id_key = strtolower($class)."_id";

		$statement = "select * from $class where $id_key = ?";
		$statement = db()->prepare($statement);
		$statement->execute([isset($this->$id_key) ? $this->$id_key : -1]);

		$count = 0;
		if($statement->fetch())
		{
			$count = $this->update();
		}
		else
		{
			$count = $this->create();
		}
		return $count;
	}

	public function update()
	{
		$class = strtolower(get_called_class());
		$attributes = get_object_vars($this);
		$id_key = strtolower($class)."_id";

		$statement = "update $class set ";
		foreach ($attributes as $key => $value) {
			if($key == $id_key)
				continue;

			$statement .= "$key = :".$key .","; 
		}
		$statement = rtrim($statement, ',');
		$statement .= " where $id_key = :$id_key";


		$statement = db()->prepare($statement);
		$statement->execute($attributes);
		return $statement->rowCount();
	}

	public function delete()
	{
		$class = strtolower(get_called_class());
		$id_key = strtolower($class)."_id";

		$statement = "delete from $class where $id_key = ?";
		$statement = db()->prepare($statement);
		$statement->execute([$this->$id_key]);
		
		return $statement->rowCount();
	}

	public static function destroy($id)
	{
		$class = strtolower(get_called_class());
		$id_key = strtolower($class)."_id";

		$statement = "delete from $class where $id_key = ?";
		$statement = db()->prepare($statement);
		$statement->execute([$id]);

		return $statement->rowCount();
	}

	public function fillAttributes($array)
	{
		foreach ($array as $key => $value) {
			$this->$key = $value;
		}
	}

	public static function exists($id)
    {
		$class = strtolower(get_called_class());
		$id_key = strtolower($class) . "_id";
        $statement = "select '' from $class where $id_key = :id";
        $statement = db()->prepare($statement);
        $statement->execute(["id" => $id]);

        return !empty($statement->fetch());
    }
}