<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Contacts implements NodeInterface {

    /**
     * @var array
     */
    private $contacts = [];

    /**
     * @param array $attributes
     */
    public function __construct($attributes) {
        foreach ($attributes as $contact) {
            $this->setContact($contact);
        }
    }

    /**
     * @param ContactType $contact
     */
    public function setContact($contact) {
        $this->contacts[$contact->type] = $contact;
    }

    /**
     * @param string $type
     * @return object|null
     */
    public function getContact($type) {
        return isset($this->contacts[$type]) ? $this->contacts[$type] : NULL;
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = NULL) {
        if (NULL === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Contacts');
        foreach ($this->contacts as $contact) {
            $node->appendChild($contact->toNode($document));
        }

        return $node;
    }
}
