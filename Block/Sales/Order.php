<?php
namespace Webkul\PriceFee\Block\Sales;

use Magento\Framework\View\Element\Template;

class Order extends \Magento\Framework\View\Element\Template {

    protected $_order;
    protected $_source;

    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        $title = 'Custom Fee(Q)';
        $store = $this->getStore();
            $customAmount = new \Magento\Framework\DataObject(
                [
                    'code' => 'customfee',
                    'strong' => false,
                    'value' => $this->_order->getCustomfee(),
                    'label' => __($title),
                ]
            );
            $parent->addTotal($customAmount,'customfee');
        return $this;
    }

    public function getStore()
    {
        return $this->_order->getStore();
    }
    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }
    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }
    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

    public function getSource()
    {
        return $this->_source;
    }

    public function displayFullSummary()
    {
        return true;
    }
}