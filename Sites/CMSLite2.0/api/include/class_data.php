<?php
class data{
    private $name;
    private $path;
    private $resourceType;
    
    private $another_name;
    private $another_path;
    private $another_resourceType;

    public function __construct(string $dataName) {
        $this->resourceType = $dataName;
        $this->name = "{$dataName}.json";
        $this->path = realpath(__DIR__.'/../data').'/'.$this->name;

        $dataName == 'contacts' ?  $this->another_resourceType = 'deals' : $this->another_resourceType = 'contacts';
        $this->another_name = "{$this->another_resourceType}.json";
        $this->another_path = realpath(__DIR__.'/../data').'/'.$this->another_name;
    }

    private function getRelatedData(array $ids, string $relatedResource): array {
        $relatedPath = dirname($this->path).'/'.$relatedResource.'.json';
        if (!file_exists($relatedPath)) {
            return [];
        }

        $relatedItems = json_decode(file_get_contents($relatedPath), true);
        if (!is_array($relatedItems)) {
            return [];
        }

        $result = [];
        foreach ($relatedItems as $item) {
            if (isset($item['id']) && in_array($item['id'], $ids)) {
                if ($relatedResource === 'contacts') {
                    $result[] = [
                        'id' => $item['id'],
                        'first_name' => $item['first_name'] ?? '',
                        'last_name' => $item['last_name'] ?? ''
                    ];
                } elseif ($relatedResource === 'deals') {
                    $result[] = [
                        'id' => $item['id'],
                        'name' => $item['name'] ?? ''
                    ];
                }
            }
        }
        return $result;
    }

    function get($id = null) : array|false  {
        if (!file_exists($this->path)) {
            return false;
        }
        
        $data = json_decode(file_get_contents($this->path), true);
        if (!is_array($data)) {
            return false;
        }

        if ($id !== null) {
            foreach ($data as $item) {
                if (isset($item['id']) && $item['id'] == $id) {
                    if ($this->resourceType === 'deals' && !empty($item['contacts'])) {
                        $item['contacts'] = $this->getRelatedData($item['contacts'], 'contacts');
                    } elseif ($this->resourceType === 'contacts' && !empty($item['deals'])) {
                        $item['deals'] = $this->getRelatedData($item['deals'], 'deals');
                    }
                    return $item;
                }
            }
            return false;
        }
        return $data;
    }
    
    function delete(int $id) : bool {
        if (!file_exists($this->path)) {
            return false;
        }
        $data = json_decode(file_get_contents($this->path), true);
        $found = false;
        for ($i=0; $i < count($data) ; $i++) { 
            if ($data[$i]['id'] == $id) {
                $found = true;
                unset($data[$i]);
                break;
            }
        }
        
        if ($found) {
            $another_data = json_decode(file_get_contents($this->another_path), true);
            if (count($another_data) > 0){
                foreach ($another_data as &$item) {
                    if (in_array($id, $item[$this->resourceType])) {
                        $item[$this->resourceType] = array_values(array_diff($item[$this->resourceType], [$id]));
                    }
                }
                file_put_contents($this->another_path, json_encode($another_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }
        
        file_put_contents($this->path, json_encode(array_values($data), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $found;
    }

    function insert(array $newData) : bool {
        if (!file_exists($this->path)) {
            return false;
        }

        $data = json_decode(file_get_contents($this->path), true);
        $newData_id = 0;
        if (empty($data)) {
            $newData_id = 1;
            $newData = ['id' => $newData_id] + $newData;
            $data = [$newData];
        }else{
            $newData_id = end($data)['id']+1;
            $newData = ['id' => $newData_id] + $newData;
            $data[] = $newData;
        }

        $complete = file_put_contents($this->path,json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if ($complete) {
            $another_data = json_decode(file_get_contents($this->another_path), true);
            if (count($another_data) > 0 && $newData_id != 0) {
                foreach ($another_data as &$item) {
                    if (in_array($item['id'], $newData[$this->another_resourceType])) {
                        $item[$this->resourceType][] = $newData_id;
                    }
                }

                file_put_contents($this->another_path, json_encode($another_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }
        
        return ($complete !== false);
    }
    
    function update(int $id, array $newData) : bool {
        if (!file_exists($this->path)) {
            return false;
        }

        $data = json_decode(file_get_contents($this->path), true);

        $found = false;
        foreach ($data as &$item) {
            if ($item['id'] == $id) {
                $found = true;
                $item = $newData;
                break;
            }
        }

        if ($found) {
            $complete = file_put_contents($this->path,json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            if ($complete) {
                $another_data = json_decode(file_get_contents($this->another_path), true);
                if (count($another_data) > 0 && $found) {
                    foreach ($another_data as &$item) {
                        if (in_array($id, $item[$this->resourceType])) {
                            if (in_array($item['id'], $newData[$this->another_resourceType]) == false) {
                                $item[$this->resourceType] = array_values(array_diff($item[$this->resourceType], [$id]));
                            }
                        } else {
                            if (in_array($item['id'], $newData[$this->another_resourceType])) {
                                $item[$this->resourceType][] = $id;
                            }
                        }
                    }
                    file_put_contents($this->another_path, json_encode($another_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
            }
        }
        return ($complete !== false);
    }
}
?>