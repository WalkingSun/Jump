<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/7/3
 * Time: 6:38 PM
 */


class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {

        if( $l1->val==0 ) return $l2;
        if( $l2->val==0 ) return $l1;

        $size1 = 0;
        $size2 = 0;

        $prev1 = $l1;
        $prev2 = $l2;
        while( $prev1 ){
            $size1++;
            $prev1 = $prev1->next;
        }

        while( $prev2 ){
            $size2++;
            $prev2 = $prev2->next;
        }

        $maxsize = max($size1,$size2);

        //todo 补零操作


        $prev1 = $l1;
        $prev2 = $l2;

        $sum=0;
        for($i=$maxsize;$i>0;$i--){
            $val1 =  $prev1->val?:0;
            $val2 =  $prev2->val?:0;
            $sum+=($val1+$val2)*pow(10,$i-1);
            $prev1 = $prev1->next?$prev1->next:new ListNode(0);
            $prev2 = $prev2->next?$prev2->next:new ListNode(0);
        }

        // 生成新链表
        $node = new ListNode(0);
        while( $sum ){
            $val = $sum%10;

            if( !isset($prev) ){
                $node =  new ListNode($val);
                $prev = $node;
            }else{

                $prev->next = new ListNode($val);
                $prev = $prev->next;
            }

            $sum = intval($sum/10);
        }



        var_export($node);die;

    }
}

$l1 = new ListNode(9);
$l1->next = new ListNode(8);
$l1->next->next = new ListNode(7);
//$l2 = new ListNode(0);
$l2->next = new ListNode(2);
$l2->next->next = new ListNode(3);

$Solution = new Solution();
$Solution->addTwoNumbers($l1,$l2);
