<?php
abstract class Model
{
    abstract protected function getFileName();
    abstract protected function valid();
    abstract protected function getArray();

    public function find($query) {
        $data = $this->load();

        if($query == 'all') {
            return $data;
        } else if(is_string($query)) {
            return @$data[$query];
        }

        return NULL;
    }

    // saves this model to a file
    public function save() {
        $data = $this->load();
        $uid = uniqid();
        $arr = $this->getArray();

        if(!array_key_exists('id', $arr))
            $arr['id'] = $uid;

        $data[$uid] = $arr;
        $this->unload($data);
        $this->clear_cache_files();
    }

    public function update($id) {
        $data = $this->load();

        $arr = $this->getArray();
        if(!array_key_exists('id', $arr))
            $arr['id'] = $id; 

        $data[$id] = $arr;
        $this->unload($data);
        $this->clear_cache_files();
    }

    public function delete($id) {
        $data = $this->load();
        unset($data[$id]);
        $this->unload($data);
        $this->clear_cache_files();
    }

    private function clear_cache_files() {
        array_map('unlink', glob('cache/*'));
    }

    // Read the file and loads the data, returns an array
    private function load() {
        return unserialize(file_get_contents('data/' . $this->getFileName()));
    }
    
    // Saves the passed data to the specified file name
    private function unload($data) {
        file_put_contents('data/' . $this->getFileName(), serialize($data));
    }
}