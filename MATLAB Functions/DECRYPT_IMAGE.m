function [ output_args ] = DECRYPT_IMAGE( ENCR,seed )
%UNTITLED9 Summary of this function goes here
%   Detailed explanation goes here
s = RandStream('mt19937ar','Seed',seed);
[C,D]=size(ENCR)
KEY=randperm(s,C);
H(KEY)=ENCR;
M=H(1);
N=H(2);
G=H(3:end);
DECR=reshape(G',[M,N,3]);
figure,image(uint8(DECR))

end

