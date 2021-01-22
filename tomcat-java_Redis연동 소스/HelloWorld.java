import redis.clients.jedis.Jedis;

public class HelloWorld {
    public static void main(String ars[]){
        Jedis jedis = new Jedis("10.0.3.7", 6379);
        jedis.set("firstword", "Hello");
        jedis.set("secondword", "World");
        System.out.println(jedis.get("firstword")+" "+jedis.get("secondword"));
        jedis.set("key-1", "key1-value"); 
        jedis.set("key-2", "key2-value");		
        System.out.println(jedis.get("key-1")+" "+jedis.get("key-2"));
        jedis.set("key-3", "key3-value"); 
        jedis.set("key-4", "key4-value");		
        System.out.println(jedis.get("key-3")+" "+jedis.get("key-4"));
    }
}
