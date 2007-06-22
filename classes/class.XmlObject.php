<?php

/**
  * Class for storing simple Objects in XML. Simple Objects means that the objet has simples attributes.
  * The attributes can not be an object.
  * @author Augusto Cesar Castoldi <castoldi@inf.ufsc.br>
  * @date 2003-11-28
  */
class XmlObject
{

  /**
    * Save the $object into the XML $xmlPath
    * @param object $object Object that will be stored in XML
    * @param string $xmlPath complete path of the xml file. Ex.: /home/user/test/XmlArrayTest.xml
    */
  function saveObject($object, $xmlPath)
  {
    $class_vars = get_object_vars($object);

    $xml = domxml_new_doc("1.0");
    $elements = $xml->create_element(get_class($object));
    $elementsNode = $xml->append_child($elements);

    foreach ($class_vars as $name => $value)
    {
      $element = $xml->create_element($name);
      $element->set_content($value);
      $elementsNode->append_child($element);
    }

    $xml->dump_file($xmlPath, false, true);
  }

  /**
    * Reads the $xmlPath file and returns an object.
    * @param object $object It's necessary to pass an clean object to save the attributes
    * @param string $xmlPath complete path of the xml file. Ex.: /home/user/test/XmlArrayTest.xml
    * @return object returns the object passed by parameter, with all his properties that was on the XML.
    */
  function getObject($object, $xmlPath)
  {
    $i = 0;

    if (!file_exists($xmlPath))
      return;

    $xml = domxml_open_file ($xmlPath);
    $node = $xml->document_element();

    $ChildDomNode = $node->first_child();

    while($ChildDomNode)
    {
      if ($ChildDomNode->type == XML_ELEMENT_NODE)
      {
        $name = $ChildDomNode->node_name();
        $object->$name = trim($ChildDomNode->get_content());
        $i++;
      }
      $ChildDomNode = $ChildDomNode->next_sibling();
    }
    return $object;
  }
}

?>