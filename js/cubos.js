var hexaDemo1,
            text1 = 'PEOPLE'.split(''),
            text2 = 'REVOLUTION'.split(''),
            settings = {
                size: 30,
                margin: 12,
                fontSize: 20,
                perspective: 450
            },
            makeObject = function(a){
                var o = {};
                for(var i = 0, l = a.length; i < l; i++){
                    o['letter' + i] = a;
                }
                return o;
            },
            getSequence = function(a, reverse, random){
                var o = {}, p;
                for(var i = 0, l = a.length; i < l; i++){
                    if(reverse){
                        p = l - i - 1;
                    }else if(random){
                        p = Math.floor(Math.random() * l);
                    }else{
                        p = i;
                    }
                    o['letter' + i] = a[p];
                }
                return o;
            };
    
        document.addEventListener('DOMContentLoaded', function(){
            hexaDemo1 = new HexaFlip(document.getElementById('hexaflip-demo1'), makeObject(text1), settings);
            hexaDemo2 = new HexaFlip(document.getElementById('hexaflip-demo2'), makeObject(text2), settings);
    
            setTimeout(function(){
                hexaDemo1.setValue(getSequence(text1, true));
                hexaDemo2.setValue(getSequence(text2, true));
            }, 0);
    
            setTimeout(function(){
                hexaDemo1.setValue(getSequence(text1));
                hexaDemo2.setValue(getSequence(text2));
            }, 1000);
    
            setTimeout(function(){
                setInterval(function(){
                    hexaDemo1.setValue(getSequence(text1, false, true));
                    hexaDemo2.setValue(getSequence(text2, false, true));
                }, 8000);
            }, 10000);
        }, false);