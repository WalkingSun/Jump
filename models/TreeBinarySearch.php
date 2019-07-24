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
    public $size=0;

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

    public function selectBinary( $node, $value  ){

        if($node==null)
            return false;

        if( $node->val == $value ){
            return $node;
        }

        if( $node->val > $value ){
            return  $this->selectBinary($node->left,$value);
        }else{
            return  $this->selectBinary($node->right,$value);
        }

    }

    /**查询
     * @param string $type 'pre'前序遍历，'in'中序遍历，'last'后序遍历
     */
    public function select( $value=null,$type='pre' ){
        if($value)
            return $this->selectBinary($this,$value);

        switch ( $type ){
            case 'pre':
                return $this->selectPreorderByStack($this);
                break;
            case 'in':
                return $this->selectInorder($this);    //中序结果是顺序结构
                break;
            case 'last':
                return $this->selectLastorder($this);   //后序遍历 应用：未二分搜索树释放内存
                break;
        }
    }

    /**
     * 查询最小值
     */
    public function selectMin( $node ){
        if( $node->left != null ){
            $this->selectMin($node->left);
        }

        return $node;

    }

    /**
     * 查询最大值
     */
    public function selectMax( $node ){
        if( $node->right != null ){
            $this->selectMax($node->right);
        }

        return $node;
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
            $this->size++;
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

    /**
     * 删除最小节点
     * @param TreeBinarySearch $node
     */
    public function deleteMin( $node ){
        if( $node->left==null ){
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }

        $node->left = $this->deleteMin($node->left);
        return $node;
    }

    /**
     * 删除最大节点
     * @param  TreeBinarySearch $node
     */
    public function deleteMax($node){
        if( $node->right == null ){
            $leftNode = $node->left;
            $node->left = null;
            $this->size--;
            return $leftNode;
        }
        $node->right = $this->deleteMax($node->right);
        return $node;
    }

    /**
     * 删除任意节点
     * @param $node
     * @param $value
     */
    public function delete($value){
        return $this->deleteByRecursion($this,$value);
    }

    public function deleteByRecursion($node,$value){
        if( $this->size==0 )
            throw new \Exception('节点为空');

        //空返回错误
        if( $node==null )
            return false;

        //找到节点
        if(  $node->val != $value ){
            //先从左节点找 再又节点  性能较差
//            return $this->deleteByRecursion($node->left,$value) or $this->deleteByRecursion($node->right,$value);
            //二分查找
            $node =  $this->select($value);
        }

        //目标节点左右节点为空 返回空
        if( $node->left==null && $node->right == null ){
            $node->val=null;
            $this->size--;
            return $node;
        }

        //右节点
        if( $node->right ){
            //获取右边最大值
            $nodeRightMin = $this->selectMin($node->right);

            //当前节点
            $node->val = $nodeRightMin->val;
            $node->right = $this->deleteMin($node->right);
        }else{
            //获取左节点最大值
            $nodeLeftMax = $this->selectMax($node->left);
            $node->val = $nodeLeftMax->val;
            $node->left = $this->deleteMax($node->left);
        }

        return $node;
    }


}