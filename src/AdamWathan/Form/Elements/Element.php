<?php namespace AdamWathan\Form\Elements;

abstract class Element
{
    protected $attributes = array();

    protected function setAttribute($attribute, $value = null)
    {
        if (is_null($value)) {
            return;
        }

        $this->attributes[$attribute] = $value;
    }

    public function getAttribute($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }
        return null;
    }

    public function getType()
    {
        return $this->getAttribute('type');
    }

    protected function removeAttribute($attribute)
    {
        unset($this->attributes[$attribute]);
    }

    public function data($attribute, $value)
    {
        $this->setAttribute('data-'.$attribute, $value);
        return $this;
    }

    public function attribute($attribute, $value)
    {
        $this->setAttribute($attribute, $value);
        return $this;
    }

    public function clear($attribute)
    {
        if (! isset($this->attributes[$attribute])) {
            return $this;
        }

        $this->removeAttribute($attribute);
        return $this;
    }

    protected function classesToArray()
    {
        if (isset($this->attributes['class'])) {
            return explode(' ', $this->attributes['class']);
        }
        return array();
    }

    protected function arrayToClass($classes)
    {
        return implode(' ', array_unique($classes));
    }

    public function addClass($class)
    {
        $classes = $this->classesToArray();
        $classes[] = $class;
        $this->setAttribute('class', $this->arrayToClass($classes));
        return $this;
    }

    public function removeClass($class)
    {
        $classes = $this->classesToArray();
        $classes = array_diff($classes, array($class));
        $this->setAttribute('class', $this->arrayToClass($classes));
        return $this;
    }

    public function id($id)
    {
        $this->setId($id);
        return $this;
    }

    protected function setId($id)
    {
        $this->setAttribute('id', $id);
    }

    abstract public function render();

    public function __toString()
    {
        return $this->render();
    }

    protected function renderAttributes()
    {
        $result = '';

        foreach ($this->attributes as $attribute => $value) {
            $result .= " {$attribute}=\"{$value}\"";
        }

        return $result;
    }

    public function __call($method, $params)
    {
        $params = array_merge(array($method), $params);
        call_user_func_array(array($this, 'attribute'), $params);
        return $this;
    }
}
