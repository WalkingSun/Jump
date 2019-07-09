<?php
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 2019/5/10
 * Time: 10:31 AM
 */

namespace app\models;

/**二分搜索树操作
 * Class TreeBinarySearch
 * @package app\models
 */
class TreeBinarySearch
{
    public $val = null;
    public $left = null;
    public $right = null;

    public function __construct($value=null){
        $this->val = $value;
    }


    /**添加元素
     * @param $value
     * @return TreeBinarySearch
     */
    public function add( $value ){
        $node = $this;
        return $this->add2($node,$value);
    }


    /**查询
     * @param string $type 'pre'前序遍历，'in'中序遍历，'last'后序遍历
     */
    public function select( $type='pre' ){
        switch ( $type ){
            case 'pre':
                $this->selectPreorderByStack($this);
                break;
            case 'in':
                $this->selectInorder($this);    //中序结果是顺序结构
                break;
            case 'last':
                $this->selectLastorder($this);   //后序遍历 应用：未二分搜索树释放内存
                break;
        }
    }


    public function add2( $node,$value ){
        if(!is_object($node)){
            $node = new TreeBinarySearch(null);
        }

        if( $node->val == $value ){
            return $node;
        }

        if( $node->val == null ){
            $node->val = $value;
            return $node;
        }

        if( $node->val > $value){
             $node->left = $this->add2($node->left,$value);
        }

        if( $node->val < $value ){
             $node->right = $this->add2($node->right,$value);
        }

        return $node;
    }


    /**
     * 前序遍历
     */
    public function selectPreorder($node,$level=1){
        if( $node == null ){
            return;
        }

        echo $this->deepShow($level);
        echo $node->val . "\n";

        $this->selectPreorder($node->left,$level+1);

        $this->selectPreorder($node->right,$level+1);
    }


    /**
     *  前序遍历（栈）
     */
    public function selectPreorderByStack($node){
        //栈
        $stack = [];
        array_push($stack,$node);
        while (!empty($stack)){

            $cur = array_pop($stack);

            echo $cur->val . "\n";


            if( $cur->right ){
                $stack[] = $cur->right;
            }

            if( $cur->left ){
                $stack[] = $cur->left;
            }
        }
    }

    /**
     * 中序遍历
     */
    public function selectInorder($node,$level=1){
        if( $node == null ){
            return;
        }

        $this->selectInorder($node->left,$level+1);

        echo $this->deepShow($level);
        echo $node->val . "\n";

        $this->selectInorder($node->right,$level+1);
    }

    /**
     * 中序遍历(栈)
     */
    public function selectInorderByStack($node){

        $stack = [$node];
        while( !empty($stack) ){

            $cur = array_pop($stack);

            if( $cur->left ){
                $stack[] = $cur->left;
            }else{
                echo $cur->val . "\n";
            }


            if( $cur->right ){
                $stack[] = $cur->right;
            }else{
                echo $cur->val . "\n";
            }




        }



    }

    /**
     * 后序遍历
     */
    public function selectLastorder($node,$level=1){
        if( $node == null ){
            return;
        }

        $this->selectLastorder($node->right,$level+1);

        echo $this->deepShow($level);
        echo $node->val . "\n";

        $this->selectLastorder($node->left,$level+1);

    }


    /**
     * 树深度
     */
    protected function deepShow($deep){
        while($deep--){
            echo '--';
        }
    }

}